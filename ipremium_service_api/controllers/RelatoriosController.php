<?php

namespace app\controllers;

use app\models\Dispositivos;
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
class RelatoriosController extends ActiveController
{
    public $modelClass = 'app\models\Relatorios';

    public function actionEstatistica($mes){
        if($mes == "anual"){
            $avariasTotal = Avarias::find()->all();
            $dispositivosTotal = Dispositivos::find()->all();
            $avariasNR = Avarias::find()->where(["estado" => 0])->count();
            $avariasR = Avarias::find()->where(["estado" => 2])->count();
            $dispositivosNF = Dispositivos::find()->where(["estado" => 0])->count();
            $dispositivosF = Dispositivos::find()->where(["estado" => 1])->count();
        }
        elseif($mes > 12 || $mes < 1){
            if($mes != "anual" && !is_numeric($mes)){
                throw new \yii\web\HttpException(404, "Insira 'anual' para consultar a estatistica anual", 404);
            }else{
                throw new \yii\web\HttpException(404, "Mes solicitado não existe (1/12)");
            }
        }
        else{
            $avariasTotal = Avarias::find()->where(["MONTH(data)" => $mes])->all();
            $dispositivosTotal = Dispositivos::find()->where(["MONTH(datacompra)" => $mes])->all();
            $avariasNR = Avarias::find()->where(["estado" => 1, "MONTH(data)" => $mes])->count();
            $avariasR = Avarias::find()->where(["estado" => 3, "MONTH(data)" => $mes])->count();
            $dispositivosNF = Dispositivos::find()->where(["estado" => 0, "MONTH(datacompra)" => $mes])->count();
            $dispositivosF = Dispositivos::find()->where(["estado" => 1, "MONTH(datacompra)" => $mes])->count();
        }

        return [
            "avariasTotal" => count($avariasTotal),
            "avariasNR" => $avariasNR,
            "avariasR" =>$avariasR,
            "dispositivosNF" => $dispositivosNF,
            "dispositivosF" => $dispositivosF
        ];
    }

    public function behaviors()
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
    }
}
