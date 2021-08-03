<?php

namespace app\controllers;

use Yii;
use app\models\Pacientepatologia;
use app\models\PacientepatologiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PacientepatologiaController implements the CRUD actions for Pacientepatologia model.
 */
class PacientepatologiaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'rules' => [
                    [
                    'allow'=>true,
                    'roles'=>['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pacientepatologia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PacientepatologiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pacientepatologia model.
     * @param integer $paciente_id
     * @param integer $patologia_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($paciente_id, $patologia_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($paciente_id, $patologia_id),
        ]);
    }

    /**
     * Creates a new Pacientepatologia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pacientepatologia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'paciente_id' => $model->paciente_id, 'patologia_id' => $model->patologia_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pacientepatologia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $paciente_id
     * @param integer $patologia_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($paciente_id, $patologia_id)
    {
        $model = $this->findModel($paciente_id, $patologia_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'paciente_id' => $model->paciente_id, 'patologia_id' => $model->patologia_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pacientepatologia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $paciente_id
     * @param integer $patologia_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($paciente_id, $patologia_id)
    {
        $this->findModel($paciente_id, $patologia_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pacientepatologia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $paciente_id
     * @param integer $patologia_id
     * @return Pacientepatologia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($paciente_id, $patologia_id)
    {
        if (($model = Pacientepatologia::findOne(['paciente_id' => $paciente_id, 'patologia_id' => $patologia_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
