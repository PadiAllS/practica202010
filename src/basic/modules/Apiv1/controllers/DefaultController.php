<?php

namespace app\modules\apiv1\controllers;

use yii\web\Controller;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth; 
use app\models\Usuario;
use Yii;

/**
 * Default controller for the `apiv1` module
 */
class DefaultController extends ActiveController
{
   

}
