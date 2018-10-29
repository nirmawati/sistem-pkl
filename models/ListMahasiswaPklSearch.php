<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ListMahasiswaPkl;

/**
 * ListMahasiswaPklSearch represents the model behind the search form of `app\models\ListMahasiswaPkl`.
 */
class ListMahasiswaPklSearch extends ListMahasiswaPkl
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mahasiswa_id', 'kegiatan_id'], 'integer'],
            [['tgl_mulai', 'tgl_selesai'], 'safe'],
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
        $query = ListMahasiswaPkl::find();

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
            'kegiatan_id' => $this->kegiatan_id,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
        ]);

        return $dataProvider;
    }
}
