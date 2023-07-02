<?php

namespace app\controllers;

use app\models\Contract;
use app\models\ContractSerach;
use app\models\ContractService;
use app\models\Patient;
use Mpdf\Tag\Code;
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
                if ($model->getSave() && $model->service) {
                    // Добавляем услуги
                    $service = new ContractService();
                    $service->service_list = $model->service;
                    $service->id_contract = $model->id;
                    $service->addService();
                    $model->summ = $service->_summ ?? 0;
                    $model->getSave();
                    return $this->redirect('index');
                }
            } catch (\Exception $ex) {
                $model->setErrorFlash('danger', $ex->getMessage());
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

    /**
     * @param int $id ID
     * @param int $type ID
     */
    public function actionDownload($id, $type)
    {

        $model = Contract::find()
            ->joinWith(['patient'])
            ->joinWith(['representative'])
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


        $_type = [
            1 => 'Взрослый договор платных услуг',
            2 => 'Детский договор платных услуг',
            3 => 'Согласие для детей',
        ];

        $_type_file = [
            1 => 'upload/contract.docx',
            2 => 'upload/contarct_child.docx',
            3 => 'upload/child_approval.docx',
        ];
        
        $file = str_replace(' ', '_', $path . '/'.$_type[$type].' '.$model->patient->fullname.'.docx');

        $config  = [
            'space' => ['before' => 0, 'after' => 0],
            'indentation' => ['left' => 0, 'right' => 0]
        ];

        $table = new Table(array('borderSize' => 0, 'borderColor' => 'black', 'borderTopSize' => 1, 'width' => '100px'));
        $table->getStyle(['width' => 100]);
        $service_list = ContractService::find()
            ->joinWith(['prices'])
            ->joinWith(['contract'])
            ->where(['id_contract' => $id])
            ->andFilterWhere(['is', 'contract_service.deleted', new \yii\db\Expression('null')])
            ->all();

        $table->addRow();
        $table->addCell(2000)->addText('Дата/ Срок исполнения', ['size' => 8, 'bold' =>true], $config);
        $table->addCell(1000)->addText('№ по прейскуранту', ['size' => 8, 'bold' =>true], $config);
        $table->addCell(6700)->addText('Наименование услуги', ['size' => 8, 'bold' =>true], $config);
        $table->addCell(800)->addText('Стоимость', ['size' => 8, 'bold' =>true], $config);
        foreach ($service_list as $item) {
            $table->addRow();
            $table->addCell()->addText($item->contract->date_to . '/' . $item->contract->date_do, ['size' => 8], $config);
            $table->addCell()->addText($item->prices->code, ['size' => 8], $config);
            $table->addCell()->addText($item->prices->category.'. '.$item->prices->name, ['size' => 8], $config);
            $table->addCell()->addText($item->prices->price, ['size' => 8], $config);
        }

        $brith = $model->patient->brithday;
        $brith_re = $model->representative->brithday;
        $brith = strtotime($brith);
        $brith_re = strtotime($brith_re);
        $model->date_to = strtotime($model->date_to);
        $model->date_do = strtotime($model->date_do);
        $model->date_ct = strtotime($model->date_ct);
        $_brith_re = '"' . date('d', $brith_re) . '" ' . $model->month_incline()[date('n', $brith_re)] . ' ' . date('Y', $brith_re) . '';
        $_brith = '"' . date('d', $brith) . '" ' . $model->month_incline()[date('n', $brith)] . ' ' . date('Y', $brith) . '';
        $_date_to = '"' . date('d', $model->date_to) . '" ' . $model->month_incline()[date('n', $model->date_to)] . ' ' . date('Y', $model->date_to) . 'г';
        $_date_do = '"' . date('d', $model->date_do) . '" ' . $model->month_incline()[date('n', $model->date_do)] . ' ' . date('Y', $model->date_do) . 'г';
        $_date = '« ' . date('d', $model->date_ct) . ' »    ' . $model->month_incline()[date('n', $model->date_ct)] . '   ' . date('Y', $model->date_ct) . 'г';

        if (file_exists($_type_file[$type])){
            $templateWord = new TemplateProcessor($_type_file[$type]);
            $templateWord->setValue('name', $model->name);
            $templateWord->setValue('fullname', $model->patient->fullname);
            $templateWord->setValue('re_fullname', $model->representative ? $model->representative->fullname : '');
            $templateWord->setValue('brithday', $_brith);
            $templateWord->setValue('brithday_re', $_brith_re);
            $templateWord->setValue('p_serial', $model->patient->passport_serial);
            $templateWord->setValue('p_number', $model->patient->passport_number);
            $templateWord->setValue('p_issued', $model->patient->passport_issued);
            $templateWord->setValue('re_p_serial', $model->representative->passport_serial);
            $templateWord->setValue('re_p_number', $model->representative->passport_number);
            $templateWord->setValue('re_p_issued', $model->representative->passport_issued);
            $templateWord->setValue('phone', $model->patient->phone);
            $templateWord->setValue('re_phone', $model->representative->phone);
            $templateWord->setValue('address', $model->patient->address_city . ' ' . $model->patient->address_street . ' ' . $model->patient->address_home . ' ' . $model->patient->address_room);
            $templateWord->setValue('re_address', $model->representative ? $model->representative->address_city . ' ' . $model->representative->address_street . ' ' . $model->representative->address_home . ' ' . $model->representative->address_room : '');
            $templateWord->setValue('date', $_date);
            $templateWord->setValue('date_to', $_date_to);
            $templateWord->setValue('date_do', $_date_do);
            $templateWord->setComplexBlock('service', $table);
            $templateWord->saveAs($file);
            Yii::$app->response->sendFile($file);
        }else{
            echo 'Шаблон не найден. Путь до файла - /web/'.$_type_file[$type]; 
        }

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
                    $model->summ = $service->_summ ?? 0;
                    $model->getSave();
                }
            } catch (\Exception $ex) {
                echo '<pre>';
                print_r($ex);
                echo '</pre>';
                die();
            }
            return $this->redirect(['update', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDogovorName(){
        $model = new Contract();
        $list = $model::find()->all();

        foreach($list as $item){
            $date_ct = strtotime($item->date_ct);
            echo date('Y-m-d', $date_ct).'..'.$model->getDogovorName($date_ct).'<br>';
            $upd = $model::findOne($item->id);
            $upd->name = $model->getDogovorName($date_ct);
            // $upd->getSave();
        }
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

        return $this->redirect('/contract/index');
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
        if (($model = Contract::find()->where(['contract.id' => $id])->joinWith(['patient', 'representative'])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
