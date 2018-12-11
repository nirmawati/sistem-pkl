<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengajuanPkl;

/**
 * PengajuanPklSearch represents the model behind the search form of `app\models\PengajuanPkl`.
 */
class PengajuanPklSearch extends PengajuanPkl
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mitra_id', 'status', 'semester', 'mhs_id', 'dosen_id', 'topik_id'], 'integer'],
            [['tanggal', 'mulai', 'selesai'], 'safe'],
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
        $query = PengajuanPkl::find();

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
            'tanggal' => $this->tanggal,
            'mitra_id' => $this->mitra_id,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
            'status' => $this->status,
            'semester' => $this->semester,
            'mhs_id' => $this->mhs_id,
            'dosen_id' => $this->dosen_id,
            'topik_id' => $this->topik_id,
        ]);

        return $dataProvider;
    }
}
