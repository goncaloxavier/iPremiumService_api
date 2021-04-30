<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Utilizador".
 *
 * @property int $idUtilizador
 * @property string $nomeUtilizador
 * @property string $palavraPasse
 * @property string $email
 * @property int $estado
 * @property int $tipo
 * @property string $idValidacao
 * @property Avarias[] $avarias
 */
class Utilizador extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomeUtilizador', 'palavraPasse', 'email', 'tipo'], 'required'],
            [['estado'], 'integer'],
            [['nomeUtilizador'], 'string', 'max' => 20],
            [['palavraPasse'], 'string', 'max' => 18],
            [['email'], 'string', 'max' => 50],
            [['idValidacao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUtilizador' => 'Id Utilizador',
            'nomeUtilizador' => 'Nome Utilizador',
            'palavraPasse' => 'Palavra Passe',
            'email' => 'Email',
            'estado' => 'Estado',
            'tipo' => 'Tipo',
            'idValidacao' => 'Id Validacao',
        ];
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if($insert)
        {
            //Definir o Estado e o IdValidacao
            $dt=Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
            $dtHash = md5($dt);
            $this->idValidacao=$dtHash;
            $this->estado=1;
            return true;
        }
        else
        {
            return true;
        }
    }

    private function SendEmail($idValidacao, $email)
    {
        $strMsg="Clique para validar: http://localhost:8888/utilizadores/validacao/".
            $idValidacao;
        return (Yii::$app->mailer->compose()
            ->setFrom('meumail@gmail.com')
            ->setTo($email)
            ->setSubject('Validacao SIS')
            ->setTextBody($strMsg)
            ->send());
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($insert)
        {
            $this->SendEmail($this->idValidacao, $this->email);
        }
    }

    public static function findByUsername($username)
    {
        $users = Utilizador::find()->all();
        foreach ($users as $user) {
            if (strcasecmp($user['nomeUtilizador'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public function validatePassword($password)
    {
        return $this->palavraPasse === $password;
    }

    public static function findIdentity($id)
    {
        $users = Utilizador::find()->all();
        return isset($users[$id]) ? new static($users[$id]) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $users = Utilizador::find()->all();
        foreach ($users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    public function getId()
    {
        return $this->idUtilizador;
    }

    public function getAuthKey()
    {
       ///return $this->idValidacao;
    }

    public function validateAuthKey($idValidacao)
    {
        ///return $this->idValidacao === $idValidacao;
    }

    public function getAvarias(){
        return $this->hasMany(Avaria::className(), ['idUtilizador' => 'idUtilizador']);
    }
}


