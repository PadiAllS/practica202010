<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pacientepatologia */

$this->title = $model->paciente_id;
$this->params['breadcrumbs'][] = ['label' => 'Pacientepatologias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pacientepatologia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'paciente_id' => $model->paciente_id, 'patologia_id' => $model->patologia_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'paciente_id' => $model->paciente_id, 'patologia_id' => $model->patologia_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'paciente_id',
            'patologia_id',
        ],
    ]) ?>

</div>
