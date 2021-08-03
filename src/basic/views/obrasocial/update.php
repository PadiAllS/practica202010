<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Obrasocial */

$this->title = 'Update Obrasocial: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Obrasocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="obrasocial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
