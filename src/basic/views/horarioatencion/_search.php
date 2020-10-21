<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HorarioatencionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horarioatencion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_horarioAtencion') ?>

    <?= $form->field($model, 'dia') ?>

    <?= $form->field($model, 'deste') ?>

    <?= $form->field($model, 'hasta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
