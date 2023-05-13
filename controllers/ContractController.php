<?php

namespace app\controllers;

use app\models\Contract;
use app\models\ContractSerach;
use app\models\ContractService;
use app\models\Patient;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ContractController implements the CRUD actions for Contract model.
 */
class ContractController extends Controller
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
     * Lists all Contract models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Contract();
        Url::remember();
        if ($model->load($this->request->post())) {
            try {
                $model->date_ct = strtotime('now');
                if($model->getSave()  && $model->service){
                    $service = new ContractService();
                    $service->service_list = $model->service;
                    $service->id_contract = $model->id;
                    $service->addService();
                }
            } catch (\Exception $ex) {
                echo '<pre>'; print_r($ex); echo '</pre>';
                die();
            }
        }

        $searchModel = new ContractSerach();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Contract model.
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
     * Creates a new Contract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Contract();

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
     * Updates an existing Contract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            // echo '<pre>'; print_r($model); echo '</pre>'; die();
            try {
                // echo '<pre>'; print_r($model); echo '</pre>'; die();
                // $model->date_to = strtotime($model->date_to);
                // $model->date_do = strtotime($model->date_do);
                $model->date_ct = strtotime($model->date_ct);
                if($model->getSave() && $model->service){
                    $service = new ContractService();
                    $service->service_list = $model->service;
                    $service->id_contract = $model->id;
                    $service->addService();
                }
            } catch (\Exception $ex) {
                echo '<pre>'; print_r($ex); echo '</pre>';
                die();
            }
            return $this->redirect(Url::previous());
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contract model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->setVisible();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Contract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Contract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contract::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
