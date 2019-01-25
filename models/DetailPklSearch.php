<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetailPkl;

/**
 * DetailPklSearch represents the model behind the search form of `app\models\DetailPkl`.
 */
class DetailPklSearch extends DetailPkl
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pkl_id', 'kesesuaian','dosen_id'], 'integer'],
            [['deskripsi_tugas', 'departemen', 'masalah', 'laporan', 'masukan_dosen','created_at', 'updated_at'], 'safe'],
            [['nilai_mentor', 'nilai_dosen', 'nilai_akhir'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DetailPkl::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pkl_id' => $this->pkl_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'dosen_id' => $this->dosen_id,
            'kesesuaian' => $this->kesesuaian,
            'nilai_mentor' => $this->nilai_mentor,
            'nilai_dosen' => $this->nilai_dosen,
            'nilai_akhir' => $this->nilai_akhir,
        ]);

        $query->andFilterWhere(['ilike', 'deskripsi_tugas', $this->deskripsi_tugas])
            ->andFilterWhere(['ilike', 'departemen', $this->departemen])
            ->andFilterWhere(['ilike', 'masalah', $this->masalah])
            ->andFilterWhere(['ilike', 'laporan', $this->laporan])
            ->andFilterWhere(['ilike', 'masukan_dosen', $this->masukan_dosen]);

        return $dataProvider;
    }
}
