<?php

namespace app\controllers;

use app\components\NotifyWidget;
use app\models\Prices;
use app\models\PricesSearch;
use PHPExcel_IOFactory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * PricesController implements the CRUD actions for Prices model.
 */
class PricesController extends Controller
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
     * Lists all Prices models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Prices();
        if ($model->load($this->request->post())) {
            try {
                if(!$model->duplicatePrice())
                    $model->getSave('Запись добавлена');
                return $this->redirect('index');
            } catch (\Exception $ex) {
                $model->setErrorFlash('danger', $ex->getMessage());
            }
        }

        $searchModel = new PricesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
        ]);
    }

    public function actionImport(){
        $data = \moonland\phpexcel\Excel::import("upload/price.xlsx");
        foreach($data as $item){
            $n = new Prices();
            $n->code = $item['code'];
            $n->name = ucfirst(strtolower($item['name']));
            $n->category = ucfirst(strtolower($item['category']));
            $n->price = $item['price'];
            $n->save();
        }
    }

    /**
     * Displays a single Prices model.
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
     * Creates a new Prices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Prices();

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
     * Updates an existing Prices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Prices model.
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

    public function actionEditField($field, $value, $id){
        try {
            $model = Prices::findOne($id);
            $model->$field = $value;
            if($model->getSave('Запись обновлена')){
                $data = ['result' => true, 'message' => NotifyWidget::widget()];
                $model->unsetSessionFlash();
                return json_encode($data);
            }
        } catch (\Exception $ex) {
            $model->setErrorFlash('danger',  $ex->getMessage());
        }
        $data = ['result' => false, 'message' => NotifyWidget::widget()];
        $model->unsetSessionFlash();
        return json_encode($data);
    }

    /**
     * Finds the Prices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Prices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prices::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
