<?php

namespace app\modules\Apiv1\controllers;

use yii\rest\ActiveController;
use app\models\ObrasocialSearch;
use app\models\PatologiaSearch;
use app\models\PacientepatologiaSearch;

use app\models\Usuario;
use app\modules\Apiv1\models\Paciente;
use app\models\PacienteSearch as ModelsPacienteSearch;
use app\modules\Apiv1\models\Patologia;
use app\modules\Apiv1\models\PacientePatologia;
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
    public $modelClass = 'app\modules\Apiv1\models\Paciente';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new ModelsPacienteSearch();
        $dataProvider =  $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }
<<<<<<< HEAD
=======
  
>>>>>>> cc9bbe6fee51c4d4a8f405083d584071763be1a8
}
