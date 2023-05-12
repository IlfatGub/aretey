<?php

use app\models\ContractService;
use app\models\Patient;
use app\models\Prices;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contract $model */
/** @var yii\widgets\ActiveForm $form */

$id_patient = $_GET['id_patient'] ?? null;
$id_patient_representative = $_GET['id_patient_representative'] ?? null;
$id = $_GET['id'] ?? null;

$service = new ContractService();
$service->id_contract = $id;

$model->service = $id ? $service->getServieByContract() : null; // указываем услуги

$model->date_ct = date('Y-m-d'); // задаем дату
$model->id_patient = $id_patient ?? $model->id_patient; // Задаем пациента
$model->id_patient_representative = $id_patient_representative ?? $model->id_patient_representative; // Задаем законного представителя

?>

<div class="contract-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'name')->textInput(['class' => 'form-control form-control-sm', 'value' => strtotime('now')]) ?>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-11 pr-0">
                    <?php echo $form->field($model, 'id_patient')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Patient::find()->orderBy(['fullname' => SORT_ASC])->all(), 'id', 'patient'),
                        'options' => ['placeholder' => 'Пациент'],
                        'size' => 'sm',
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?></div>
                <div class="col-1 ml-0 pl-0" style="top:32px">
                    <button class="btn btn-info btn-sm modalButton" title="Пациент" value="<?= Url::toRoute(['/patient/index', 'ajax' => 1, 'type' => 1, 'id_patient_representative' => $id_patient_representative]) ?>">
                        <i class="fa fa-address-card"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-11 pr-0">
                    <?php echo $form->field($model, 'id_patient_representative')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Patient::find()->orderBy(['fullname' => SORT_ASC])->all(), 'id', 'patient'),
                        'options' => ['placeholder' => 'Законный представитель'],
                        'size' => 'sm',
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?></div>
                <div class="col-1 ml-0 pl-0" style="top:32px">
                    <button class="btn btn-info btn-sm modalButton" title="Законный представитель" value="<?= Url::toRoute(['/patient/index', 'ajax' => 1, 'type' => 2, 'id_patient' => $id_patient]) ?>">
                        <i class="fa fa-address-card"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'date_ct')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Дата начала'],
                'size' => 'sm',
                'pluginOptions' => [
                    'startDate' => date('Y-m-d', time()),
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ],
            ])->label();
            ?>
        </div>
        <div class="col-8">
            <?php echo $form->field($model, 'service')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Prices::find()->orderBy(['category' => SORT_ASC])->all(), 'id', 'service'),
                'size' => 'sm',
                'theme' => Select2::THEME_KRAJEE,
                'options' => ['placeholder' => 'Услуги', 'multiple' => true, 'autocomplete' => 'off'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>