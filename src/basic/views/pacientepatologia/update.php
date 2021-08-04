<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pacientepatologia */

$this->title = 'Update Pacientepatologia: ' . $model->paciente_id;
$this->params['breadcrumbs'][] = ['label' => 'Pacientepatologias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->paciente_id, 'url' => ['view', 'paciente_id' => $model->paciente_id, 'patologia_id' => $model->patologia_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pacientepatologia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
