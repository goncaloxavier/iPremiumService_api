<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RelatoriosPecas */

$this->title = $model->idRelatorio;
$this->params['breadcrumbs'][] = ['label' => 'Relatorios Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="relatorio-peca-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idRelatorio' => $model->idRelatorio, 'idPeca' => $model->idPeca], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idRelatorio' => $model->idRelatorio, 'idPeca' => $model->idPeca], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idRelatorio',
            'idPeca',
        ],
    ]) ?>

</div>
