<?php

namespace app\modules\Apiv1\controllers;

use app\modules\Apiv1\models\Pacientepatologia;
use app\models\PacientepatologiaSearch as ModelsPacientepatologiaSearch;
use app\models\Usuario;
use yii\web\Controller;
use Yii;
use yii\rest\ActiveController;
use yii\behaviors\TimestampBehavior;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Default controller for the `apiv1` module
 */
class PacientepatologiaController extends ActiveController
{
    public $modelClass = 'app\modules\Apiv1\models\Pacientepatologia';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new ModelsPacientepatologiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }
}
