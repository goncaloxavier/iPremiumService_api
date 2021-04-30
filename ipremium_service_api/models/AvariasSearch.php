<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Avarias;

/**
 * AvariasSearch represents the model behind the search form of `app\models\Avarias`.
 */
class AvariasSearch extends Avarias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAvaria', 'tipo', 'estado', 'gravidade', 'idDispositivo', 'idRelatorio'], 'integer'],
            [['descricao', 'data'], 'safe'],
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
        $query = Avarias::find();

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
            'idAvaria' => $this->idAvaria,
            'tipo' => $this->tipo,
            'estado' => $this->estado,
            'gravidade' => $this->gravidade,
            'data' => $this->data,
            'idDispositivo' => $this->idDispositivo,
            'idRelatorio' => $this->idRelatorio,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
