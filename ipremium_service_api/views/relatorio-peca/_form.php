<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RelatoriosPecas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatorio-peca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idRelatorio')->textInput() ?>

    <?= $form->field($model, 'idPeca')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
