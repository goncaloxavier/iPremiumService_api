<?php

namespace app\controllers;

use app\models\Utilizador;
use Yii;
use app\models\Avarias;
use app\models\AvariasSearch;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvariasController implements the CRUD actions for Avarias model.
 */
class DispositivosController extends ActiveController
{
    public $modelClass = 'app\models\Dispositivos';

    public function actionByestado($estado){

        try{
            $modelDispositivo = $this->modelClass;
            $recEstado = $modelDispositivo::find()->where(["estado" => $estado])->asArray()->all();
        }catch (ErrorException $e){
            throw new \yii\web\HttpException(404, "Estado solicitado não existe (0/1)");
        }

        return $recEstado;
    }

    public function actionByref($referencia){
        try {
            $modelDispositivo = $this->modelClass;
            $rec = $modelDispositivo::find()->where(["referencia" => $referencia])->asArray()->all();
        }catch (ErrorException $e){
            throw new \yii\web\HttpException(404, "Dispositivo solicitado não existe");
        }


        return $rec;
    }

    public function actionBygravidade($referencia, $gravidade){

        if($gravidade < 0 || $gravidade > 1) {
            throw new \yii\web\HttpException(404, "Referencia solicitada não existe (0/1)");
        }
        elseif(is_string($gravidade)){
            throw new \yii\web\HttpException(404, "Referencia tem de ser numérica");
        }
        else{
            try {
                $modelDispositivo = $this->modelClass;
                $rec = $modelDispositivo::find()->where(["referencia" => $referencia])->one();
                $modelAvaria = Avarias::findBySql("SELECT * FROM avaria 
                                                WHERE idDispositivo = ".$rec->idDispositivo."
                                                and estado != 3 and gravidade =  ".$gravidade)->asArray()->all();
            }catch (ErrorException $e){
                throw new \yii\web\HttpException(404, "Dispositivo solicitado não existe");
            }
        }

        return $modelAvaria;
    }

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
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
        if(Yii::$app->user->identity->tipo != 0 && Yii::$app->user->identity->tipo != 2){
            throw new \yii\web\ForbiddenHttpException('Não tem permissões para este requisito');
        }
    }*/
}
