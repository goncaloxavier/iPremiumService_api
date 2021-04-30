<?php

namespace app\controllers;

use Yii;
use app\models\Utilizador;
use app\models\UtilizadoresSearch;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtilizadoresController implements the CRUD actions for Utilizador model.
 */
class UtilizadoresController extends ActiveController
{
    public $modelClass = 'app\models\Utilizador';

    public function actionValidacao($idvalidacao){

        $utilizador = Utilizador::find()->where(['idValidacao' => $idvalidacao])->one();
        if(is_null($utilizador)){
            echo "Erro durante validacao...";
        }
        else{
            $utilizador->idValidacao = " ";
            $utilizador->estado = 2;
            if($utilizador->save()){
                echo "Operacao realizada com sucesso";
            }else{
                echo "Impossivel validar registo";
            }
        }
    }

    public function actionAuth($nomeutilizador, $palavrapasse){
        $utilizador = Utilizador::find()->where(['nomeUtilizador' => $nomeutilizador, 'palavraPasse' => $palavrapasse])->one();
        if(is_null($utilizador)){
            return null;
        }else{
            return $utilizador;
        }
    }

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth'],
        ];
        return $behaviors;
    }

    public function auth($username, $password)
    {
        $user = Utilizador::findByUsername($username);
        if ($user && $user->validatePassword($password))
        {
            return $user;
        }
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if(Yii::$app->user->identity->tipo != 0){
            throw new \yii\web\ForbiddenHttpException('Não tem permissões para este requisito');
        }
    }*/
}
