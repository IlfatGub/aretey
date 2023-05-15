<?php

namespace app\controllers;

use app\models\Contract;
use app\models\ContractSerach;
use app\models\ContractService;
use app\models\Patient;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Table;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

date_default_timezone_set('Asia/Yekaterinburg');
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
    public function actionIndex($ajax = null, $patient_id = null)
    {
        $model = new Contract();
        Url::remember();
        if ($model->load($this->request->post())) {
            try {
                $model->date_ct = strtotime('now');
                if ($model->getSave()  && $model->service) {
                    $service = new ContractService();
                    $service->service_list = $model->service;
                    $service->id_contract = $model->id;
                    $service->addService();
                }
            } catch (\Exception $ex) {
                echo '<pre>';
                print_r($ex);
                echo '</pre>';
                die();
            }
        }

        $searchModel = new ContractSerach(['patient_id' => $patient_id]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        $data =  [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ];

        if ($ajax)
            return $this->renderAjax('index', $data);

        return $this->render('index', $data);
    }

    public function actionDownload($id)
    {

        $model = Contract::find()
            ->joinWith(['patient'])
            ->where(['contract.id' => $id])
            ->one();

        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $path = 'upload/' . $year . '/' . $month . '/' . $day;

        if (!file_exists('upload/' . $year))
            mkdir('upload/' . $year, 0777, true);

        if (!file_exists('upload/' . $year . '/' . $month))
            mkdir('upload/' . $year . '/' . $month, 0777, true);

        if (!file_exists($path))
            mkdir($path, 0777, true);

        $file = str_replace(' ', '_', $path . '/asd.docx');


        $table = new Table(array('borderSize' => 0, 'borderColor' => 'black', 'borderTopSize' => 1, 'width' => '100%'));
        $table->getStyle(['width' => 100]);
        $service_list = ContractService::find()
            ->joinWith(['price'])
            ->joinWith(['contract'])
            ->where(['id_contract' => $id])
            ->all();

        $table->addRow();
        $table->addCell()->addText('Дата/ Срок исполнения', ['size' => 8]);
        $table->addCell()->addText('№ по прейскуранту', ['size' => 8]);
        $table->addCell()->addText('Наименование услуги', ['size' => 8]);
        $table->addCell()->addText('Стоимость', ['size' => 8]);
        foreach ($service_list as $item) {

            // $device_name  = $item->typeDevice->name;
            // $old_pass = isset($item->old_passport) ? PHP_EOL.'('.$item->old_passport.')' : '';

            // //проверкат на дополнительное оборудование
            // if ($ram->existsRam()){
            //     $_rams = $ram->getRamByTehnic();
            //     $device_name .= ".";
            //     foreach ($_rams as $_ram) {
            //         $device_name .= ' + '.$_ram->name.'';
            //     }
            // }

            $table->addRow();
            $table->addCell()->addText($item->contract->date_to . '/' . $item->contract->date_do, ['size' => 8]);
            $table->addCell()->addText($item->price->id, ['size' => 8]);
            $table->addCell()->addText($item->price->name, ['size' => 8]);
            $table->addCell()->addText($item->price->price, ['size' => 8]);
        }


        $brith = $model->patient->brithday;
        $brith = strtotime($brith);
        $model->date_to = strtotime($model->date_to);
        $model->date_do = strtotime($model->date_do);
        $_brith = '"' . date('d', $brith) . '" ' . $model->month()[date('n', $brith)] . ' ' . date('Y', $brith) . 'г.';
        $_date_to = '"' . date('d', $model->date_to) . '" ' . $model->month()[date('n', $model->date_to)] . ' ' . date('Y', $model->date_to) . 'г.';
        $_date_do = '"' . date('d', $model->date_do) . '" ' . $model->month()[date('n', $model->date_do)] . ' ' . date('Y', $model->date_do) . 'г.';
        $_date = '«' . date('d') . '» ' . $model->month()[date('n')] . ' ' . date('Y') . 'г.';

        $templateWord = new TemplateProcessor('upload/contract.docx');
        $templateWord->setValue('name', $model->name);
        $templateWord->setValue('fullname', $model->patient->fullname);
        $templateWord->setValue('brithday', $_brith);
        $templateWord->setValue('p_serial', $model->patient->passport_serial);
        $templateWord->setValue('p_number', $model->patient->passport_number);
        $templateWord->setValue('p_issued', $model->patient->passport_issued);
        //  $templateWord->setValue('address', '');
        $templateWord->setValue('phone', $model->patient->phone);
        $templateWord->setValue('address', $model->patient->address_city . ' ' . $model->patient->address_street . ' ' . $model->patient->address_home . ' ' . $model->patient->address_room);
        //  $templateWord->setValue('org_name', '');
        //  $templateWord->setValue('fio_replace', '');
        $templateWord->setValue('date', $_date);
        $templateWord->setValue('date_to', $_date_to);
        $templateWord->setValue('date_do', $_date_do);
        $templateWord->setComplexBlock('service', $table);
        $templateWord->saveAs($file);
        Yii::$app->response->sendFile($file);
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
                if ($model->getSave() && $model->service) {
                    $service = new ContractService();
                    $service->service_list = $model->service;
                    $service->id_contract = $model->id;
                    $service->addService();
                }
            } catch (\Exception $ex) {
                echo '<pre>';
                print_r($ex);
                echo '</pre>';
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
