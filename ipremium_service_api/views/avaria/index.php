<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvariasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avarias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Avarias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idAvaria',
            'descricao',
            'tipo',
            'estado',
            'gravidade',
            //'data',
            //'idDispositivo',
            //'idRelatorio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
