<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Especialidad */

$this->title = 'Create Especialidad';
$this->params['breadcrumbs'][] = ['label' => 'Especialidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especialidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
