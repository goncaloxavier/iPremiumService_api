<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dispositivos;

/**
 * DispositivosSearch represents the model behind the search form of `app\models\Dispositivos`.
 */
class DispositivosSearch extends Dispositivos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idDispositivo', 'estado'], 'integer'],
            [['dataCompra', 'tipo', 'referencia'], 'safe'],
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
        $query = Dispositivos::find();

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
            'idDispositivo' => $this->idDispositivo,
            'estado' => $this->estado,
            'dataCompra' => $this->dataCompra,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'referencia', $this->referencia]);

        return $dataProvider;
    }
}
