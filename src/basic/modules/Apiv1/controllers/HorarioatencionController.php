<?php

namespace app\modules\Apiv1\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\HorarioatencionSearch;
use app\modules\Apiv1\models\Horarioatencion;


/**
 * Default controller for the `Apiv1` module
 */
class HorarioatencionController extends ActiveController
{
    
    public $modelClass = 'app\modules\Apiv1\models\Horarioatencion';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new HorarioatencionSearch();
        $dataProvider =  $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }
}
