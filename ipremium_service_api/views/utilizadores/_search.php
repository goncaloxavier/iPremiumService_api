<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UtilizadoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilizador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idUtilizador') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'nomeUtilizador') ?>

    <?= $form->field($model, 'palavraPasse') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'idValidacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
