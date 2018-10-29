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
            [['id', 'mahasiswa_id', 'status_id'], 'integer'],
            [['alamat_pkl', 'tujuan_pengirim', 'topik_pkl', 'file_krs', 'file_transkip', 'tgl_mulai', 'tgl_selesai'], 'safe'],
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
            'mahasiswa_id' => $this->mahasiswa_id,
            'status_id' => $this->status_id,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
        ]);

        $query->andFilterWhere(['like', 'alamat_pkl', $this->alamat_pkl])
            ->andFilterWhere(['like', 'tujuan_pengirim', $this->tujuan_pengirim])
            ->andFilterWhere(['like', 'topik_pkl', $this->topik_pkl])
            ->andFilterWhere(['like', 'file_krs', $this->file_krs])
            ->andFilterWhere(['like', 'file_transkip', $this->file_transkip]);

        return $dataProvider;
    }
}
