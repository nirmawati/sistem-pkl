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
            [['id', 'mitra_id', 'semester', 'mhs_id', 'dosen_id', 'status_pelaksanaan', 'status_kegiatan', 'status_surat'], 'integer'],
            [['tanggal', 'mulai','created_at', 'updated_at', 'selesai', 'topik'], 'safe'],
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'mitra_id' => $this->mitra_id,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
            'semester' => $this->semester,
            'mhs_id' => $this->mhs_id,
            'dosen_id' => $this->dosen_id,
            'topik' => $this->topik,
            'status_pelaksanaan' => $this->status_pelaksanaan,
            'status_kegiatan' => $this->status_kegiatan,
            'status_surat' => $this->status_surat,
        ]);

        return $dataProvider;
    }

}
