<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DispositivosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dispositivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idDispositivo') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'dataCompra') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'referencia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
