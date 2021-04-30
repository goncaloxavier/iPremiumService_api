<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Relatorios".
 *
 * @property int $idRelatorio
 * @property int $idAvaria
 * @property int $idDispositivo
 * @property int $idUtilizador
 * @property string|null $descricao
 */
class Relatorios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Relatorio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAvaria', 'idDispositivo', 'idUtilizador'], 'required'],
            [['idAvaria', 'idDispositivo', 'idUtilizador'], 'integer'],
            [['descricao'], 'string', 'max' => 200],
            [['idAvaria'], 'exist', 'skipOnError' => true, 'targetClass' => Avarias::className(), 'targetAttribute' => ['idAvaria' => 'idAvaria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRelatorio' => 'Id Relatorios',
            'idAvaria' => 'Id Avarias',
            'idDispositivo' => 'Id Dispositivos',
            'idUtilizador' => 'Id Utilizadores',
            'descricao' => 'Descricao',
        ];
    }
}
