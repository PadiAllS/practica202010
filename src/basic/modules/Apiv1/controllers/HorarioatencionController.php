<?php

namespace app\modules\Apiv1\controllers;

use app\models\Horarioatencion;
use yii\rest\ActiveController;

/**
 * Default controller for the `Apiv1` module
 */
class HorarioatencionController extends ActiveController
{
    
    public $modelClass = 'app\modules\Apiv1\models\Horarioatencion';
}
