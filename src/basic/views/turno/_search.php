<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TurnoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="turno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_turno') ?>

    <?= $form->field($model, 'nro_orden') ?>

    <?= $form->field($model, 'fecha_registro') ?>

    <?= $form->field($model, 'fecha_consulta') ?>

    <?= $form->field($model, 'hora_consulta') ?>

    <?php // echo $form->field($model, 'paciente_id') ?>

    <?php // echo $form->field($model, 'medico_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
