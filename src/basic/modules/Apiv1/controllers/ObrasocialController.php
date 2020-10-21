<?php

namespace app\modules\Apiv1\controllers;

//use yii\web\Controller;

use app\modules\Apiv1\models\Obrasocial;
use app\models\ObrasocialSearch as ModelsObrasocialSearch;
use app\models\Usuario;
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
class ObrasocialController extends DefaultController
{
    public $modelClass = 'app\modules\Apiv1\models\Obrasocial';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new ModelsObrasocialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }
}


