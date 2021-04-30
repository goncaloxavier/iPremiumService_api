<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Pecas".
 *
 * @property int $idPeca
 * @property string $descricao
 * @property float $custo
 */
class Pecas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Peca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'custo'], 'required'],
            [['custo'], 'number'],
            [['descricao'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPeca' => 'Id Pecas',
            'descricao' => 'Descricao',
            'custo' => 'Custo',
        ];
    }
}
