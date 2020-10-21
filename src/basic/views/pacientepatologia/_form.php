<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pacientepatologia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pacientepatologia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'paciente_id')->textInput() ?>

    <?= $form->field($model, 'patologia_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
