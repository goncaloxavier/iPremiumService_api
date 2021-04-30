<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dispositivo".
 *
 * @property int $idDispositivo
 * @property int $estado
 * @property string $dataCompra
 * @property string $tipo
 * @property string $referencia
 *
 * @property Avarias[] $avarias
 */
class Dispositivos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dispositivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['dataCompra', 'tipo', 'referencia'], 'required'],
            [['dataCompra'], 'safe'],
            [['tipo'], 'string', 'max' => 30],
            [['referencia'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idDispositivo' => 'Id Dispositivos',
            'estado' => 'Estado',
            'dataCompra' => 'Data Compra',
            'tipo' => 'Tipo',
            'referencia' => 'Referencia',
        ];
    }

    /**
     * Gets query for [[Avarias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvarias()
    {
        return $this->hasMany(Avarias::className(), ['idDispositivo' => 'idDispositivo']);
    }
}
