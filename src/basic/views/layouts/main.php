<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => '',
                //    'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'nav-pills navbar-nav ml-auto'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                [
                    "label" => "Administracion",
                    "items" => [
                        ['label' => 'Especialidad', 'url' => ['/especialidad']],
                        ['label' => 'Medico', 'url' => ['/medico']],
                        ['label' => 'Horarios', 'url' => ['/horarioatencion']],
                    ],
                    "options" => ["class" => "navbar-nav"],
                ],
                [
                    "label" => "Pacientes",
                    "items" => [
                        ['label' => 'Paciente', 'url' => ['/paciente']],
                        ['label' => 'ObraSocial', 'url' => ['/obrasocial']],
                        ['label' => 'Patologia', 'url' => ['/patologia']],
                    ],
                    "options" => ["class" => "navbar-nav"],
                ],
                ['label' => 'Turnos', 'url' => ['/turno']],
                ['label' => 'Registro', 'url' => ['/site/registro']],

                Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) : ('<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>')
            ],
        ]);
        NavBar::end();
        ?>

        <div class="">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>