<?php

namespace app\modules\v1\controllers;

use app\models\Utilizador;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\filters\auth\HttpBasicAuth;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends ActiveController
{
    public $modelClass = 'app\models\Avarias';

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
        if ($action === 'post' or $action === 'delete'){
            if (\Yii::$app->user->isGuest){
                throw new \yii\web\ForbiddenHttpException('Apenas poderá verificar as'.$action.' .');
            }
        }
    }
}
