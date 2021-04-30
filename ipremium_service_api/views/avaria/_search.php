<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvariasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaria-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAvaria') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'gravidade') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'idDispositivo') ?>

    <?php // echo $form->field($model, 'idRelatorio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
