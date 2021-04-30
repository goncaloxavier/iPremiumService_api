<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pecas */

$this->title = 'Update Pecas: ' . $model->idPeca;
$this->params['breadcrumbs'][] = ['label' => 'Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPeca, 'url' => ['view', 'id' => $model->idPeca]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
