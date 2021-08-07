<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Horarioatencion */

$this->title = 'Update Horarioatencion: ' . $model->id_horarioAtencion;
$this->params['breadcrumbs'][] = ['label' => 'Horarioatencions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_horarioAtencion, 'url' => ['view', 'id' => $model->id_horarioAtencion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="horarioatencion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
