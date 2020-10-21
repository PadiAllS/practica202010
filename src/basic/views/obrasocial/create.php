<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Obrasocial */

$this->title = 'Create Obrasocial';
$this->params['breadcrumbs'][] = ['label' => 'Obrasocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obrasocial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
