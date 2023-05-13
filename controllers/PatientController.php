<?php

namespace app\controllers;

use app\models\Patient;
use app\models\PatientSearch;
use kartik\form\ActiveForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

date_default_timezone_set('Asia/Yekaterinburg');

/**
 * PatientController implements the CRUD actions for Patient model.
 */
class PatientController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Patient models.
     * @param int $ajax при ajax запросе старницы 
     * @param int $id_patient пациента 
     * @param int $id_patient_representative законный представитель 
     * @param int $type тип запроса. 1 - добавление пациента, 2 - добавление законного представителя
     * 
     * @return string
     */
    public function actionIndex($ajax = null, $id_patient = null, $id_patient_representative = null, $type = null)
    {
        $model = new Patient();

        if ($model->load($this->request->post())) {

            if(!$model->validate() && Yii::$app->request->isAjax){
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
            }

            try {
                $model->fullname = $model->surname . ' ' . $model->name . ' ' . $model->patronymic;
                $model->brithday = strtotime($model->brithday);
                $model->getSave();
            } catch (\Exception $ex) {
                // $result = (['result' =>false, 'message' => 'Ошибка: '. $ex->getMessage()]);
                echo '<pre>'; print_r($ex);echo '</pre>';  die();
            }

            if ($ajax):
                if ($type == 1)
                    return $this->redirect(['/contract/index', 'id_patient' =>  $model->id, 'id_patient_representative' => $id_patient_representative]);
                if ($type == 2)
                    return $this->redirect(['/contract/index', 'id_patient_representative' => $model->id, 'id_patient' => $id_patient]);
            endif;

            return $this->redirect(['index']);
        }

        $searchModel = new PatientSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $data = [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
        ];

        if ($ajax){
            return $this->renderAjax('index', $data);
        }

        return $this->render('index', $data);
    }

    /**
     * Displays a single Patient model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Patient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Patient();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Patient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            try {
                $model->getSave();
            } catch (\Exception $ex) {
                echo '<pre>'; print_r($ex);echo '</pre>';  die();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Patient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->setVisible();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Patient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Patient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patient::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
