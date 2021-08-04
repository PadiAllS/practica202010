<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Horarioatencion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horarioatencion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deste')->textInput() ?>

    <?= $form->field($model, 'hasta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
