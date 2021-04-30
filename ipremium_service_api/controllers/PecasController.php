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
class PecasController extends ActiveController
{
    public $modelClass = 'app\models\Pecas';

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
