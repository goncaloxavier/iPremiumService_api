<?php

namespace app\controllers;

use app\models\Dispositivos;
use app\models\Utilizador;
use Yii;
use app\models\Avaria;
use app\models\AvariasSearch;
use yii\base\ErrorException;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvariasController implements the CRUD actions for Avarias model.
 */
class AvariasController extends ActiveController
{
    public $modelClass = 'app\models\Avarias';

   public function actionOrdered(){
        $modelAvaria = $this->modelClass;
        $rec = $modelAvaria::findBySql("SELECT * FROM avaria 
                                        WHERE avaria.estado IN (3,2,1,0) 
                                        ORDER BY FIELD(avaria.estado,0,1,2,3), data desc")->asArray()->all();
        return $rec;
    }

    public function actionByuser($user){

        try {
            $user = Utilizador::find()->where(["nomeUtilizador" => $user])->one();
            $modelAvaria = $this->modelClass;
            $recAvaria = $modelAvaria::find()->where(["idUtilizador" => $user->idUtilizador])->asArray()->all();

        }catch (ErrorException $e){
            throw new \yii\web\HttpException(404, "Utilizador solicitado não existe");
        }

        return $recAvaria;
    }

    public function actionByref($referencia){

        try {
            $dispositivo = Dispositivos::find()->where(["referencia" => $referencia])->one();
            $modelAvaria = $this->modelClass;
            $recAvaria = $modelAvaria::find()->where(["avaria.idDispositivo" => $dispositivo->idDispositivo])->asArray()->all();
        }catch (ErrorException $e){
            throw new \yii\web\HttpException(404, "Dispositivo solicitado não existe");
        }

        return $recAvaria;
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
        if(Yii::$app->user->isGuest){
            throw new \yii\web\ForbiddenHttpException('Utilizador tem de estar autenticado');
        }
    }
}
