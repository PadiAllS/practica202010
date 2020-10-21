<?php

namespace app\modules\Apiv1\controllers;

//use yii\web\Controller;
use yii\rest\ActiveController;
use app\models\MedicohorarioatencionSearch;
use app\models\HorarioatencionSearch;
use app\models\Usuario;
use app\modules\Apiv1\models\Medico;
use app\modules\Apiv1\models\MedicoSearch as ModelsMedicoSearch;
use app\modules\Apiv1\models\Horarioatencion;
use app\modules\Apiv1\models\Medicohorarioatencion;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\data\DataFilter;
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
class MedicoController extends ActiveController
{
    public $modelClass = 'app\modules\Apiv1\models\Medico';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new ModelsMedicoSearch();
        $dataProvider =  $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }
  
}
