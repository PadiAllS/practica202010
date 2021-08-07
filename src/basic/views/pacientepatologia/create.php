<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pacientepatologia */

$this->title = 'Create Pacientepatologia';
$this->params['breadcrumbs'][] = ['label' => 'Pacientepatologias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacientepatologia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
