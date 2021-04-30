<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Utilizador;

/**
 * UtilizadorSearch represents the model behind the search form of `app\models\Utilizador`.
 */
class UtilizadorSearch extends Utilizador
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUtilizador', 'estado'], 'integer'],
            [['nome', 'nomeUtilizador', 'palavraPasse', 'email', 'idValidacao'], 'safe'],
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
        $query = Utilizador::find();

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
            'idUtilizador' => $this->idUtilizador,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'nomeUtilizador', $this->nomeUtilizador])
            ->andFilterWhere(['like', 'palavraPasse', $this->palavraPasse])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'idValidacao', $this->idValidacao]);

        return $dataProvider;
    }
}
