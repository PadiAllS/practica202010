<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Turno */

$this->title = 'Update Turno: ' . $model->id_turno;
$this->params['breadcrumbs'][] = ['label' => 'Turnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_turno, 'url' => ['view', 'id' => $model->id_turno]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="turno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
