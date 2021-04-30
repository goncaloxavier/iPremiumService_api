<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RelatoriosPecas */

$this->title = 'Update Relatorios Pecas: ' . $model->idRelatorio;
$this->params['breadcrumbs'][] = ['label' => 'Relatorios Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRelatorio, 'url' => ['view', 'idRelatorio' => $model->idRelatorio, 'idPeca' => $model->idPeca]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relatorio-peca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
