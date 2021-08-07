<?php

namespace app\modules\Apiv1\controllers;

//use yii\web\Controller;
use yii\rest\ActiveController;
use app\models\PacienteSearch;
use app\models\MedicoSearch;
use app\models\Usuario;
use app\modules\Apiv1\models\Turno;
use app\modules\Apiv1\models\TurnoSearch as ModelsTurnoSearch;
use app\modules\Apiv1\models\Paciente;
use app\modules\Apiv1\models\Medico;
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
class TurnoController extends ActiveController
{
    public $modelClass = 'app\modules\Apiv1\models\Turno';

    
    
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new ModelsTurnoSearch();
        $dataProvider =  $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }
  
}
