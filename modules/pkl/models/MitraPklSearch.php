<?php

namespace app\modules\pkl\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MitraPkl;

/**
 * MitraPklSearch represents the model behind the search form of `app\models\MitraPkl`.
 */
class MitraPklSearch extends MitraPkl
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'kategori_id'], 'integer'],
            [['nama', 'alamat', 'kontak', 'telpon', 'email'], 'safe'],
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
        $query = MitraPkl::find();

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
            'status' => $this->status,
            'kategori_id' => $this->kategori_id,
        ]);

        $query->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'alamat', $this->alamat])
            ->andFilterWhere(['ilike', 'kontak', $this->kontak])
            ->andFilterWhere(['ilike', 'telpon', $this->telpon])
            ->andFilterWhere(['ilike', 'email', $this->email]);

        return $dataProvider;
    }
}
