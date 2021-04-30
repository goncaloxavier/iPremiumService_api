<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelatoriosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relatorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Relatorios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRelatorio',
            'idAvaria',
            'idDispositivo',
            'descricao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
