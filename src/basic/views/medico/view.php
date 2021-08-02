<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Medico */

$this->title = $model->id_medico;
$this->params['breadcrumbs'][] = ['label' => 'Medicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medico-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_medico], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_medico], [
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
            'id_medico',
            'nombre',
            'apellido',
            'especialidad_id',
            'direccion',
            'localidad',
            'codigo_postal',
            'telefono',
            'celular',
            'mail',
            'fecha_nacimiento',
            'sexo',
            'tipo_documento',
            'nro_documento',
            'matricula',
            'duracion_consulta',
        ],
    ]) ?>

</div>
