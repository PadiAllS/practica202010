<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Login';
?>

<div class="container-fluid justify-content-center bg-info bv-example-row text-center text-light ">
    <div class="col-12">

        <?php
        $this->title = 'Nuevo Usuario';
        ?>

        <div class="usuario-create">
            <div class="mb-12 p-3 bg-dark">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>