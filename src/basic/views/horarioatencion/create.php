<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Horarioatencion */

$this->title = 'Create Horarioatencion';
$this->params['breadcrumbs'][] = ['label' => 'Horarioatencions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="horarioatencion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
