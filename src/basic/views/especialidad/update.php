<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Especialidad */

$this->title = 'Update Especialidad: ' . $model->id_especialidad;
$this->params['breadcrumbs'][] = ['label' => 'Especialidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_especialidad, 'url' => ['view', 'id' => $model->id_especialidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="especialidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
