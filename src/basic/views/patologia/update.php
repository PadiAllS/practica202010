<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patologia */

$this->title = 'Update Patologia: ' . $model->id_patologia;
$this->params['breadcrumbs'][] = ['label' => 'Patologias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_patologia, 'url' => ['view', 'id' => $model->id_patologia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patologia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
