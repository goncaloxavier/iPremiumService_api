<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatorio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idAvaria')->textInput() ?>

    <?= $form->field($model, 'idDispositivo')->textInput() ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
