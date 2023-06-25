<?php

use app\models\ContractService;
use app\models\Patient;
use app\models\Prices;
use Faker\Core\DateTime;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contract $model */
/** @var yii\widgets\ActiveForm $form */
$model->getDogovorName();

$id_patient = $_GET['id_patient'] ?? null;
$id_patient_representative = $_GET['id_patient_representative'] ?? null;
$id = $_GET['id'] ?? null;

$service = new ContractService();
$service->id_contract = $id;

$model->service = $id ? $service->getServieByContract() : null; // указываем услуги

$model->date_ct = date('d.m.Y H:i:s'); // задаем дату
$model->date_to = $model->date_to ?? date('d.m.Y'); // задаем дату
$model->date_do = $model->date_do ?? date('d.m.Y'); // задаем дату
$model->id_patient = $id_patient ?? $model->id_patient; // Задаем пациента
$model->id_patient_representative = $id_patient_representative ?? $model->id_patient_representative; // Задаем законного представителя

$patient_list = ArrayHelper::map(Patient::find()->orderBy(['fullname' => SORT_ASC])->all(), 'id', 'patient');
?>

<div class="contract-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'name')->textInput(['class' => 'form-control form-control-sm', 'value' => $model->getDogovorName()]) ?>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-11 pr-0">
                    <?php $model->select2($form, 'id_patient', $patient_list, 'Пациент'); ?>
                </div>
                <div class="col-1 ml-0 pl-0" style="top:32px">
                    <button class="btn btn-info btn-sm modalButton" type="button" title="Пациент" value="<?= Url::toRoute(['/patient/index', 'ajax' => 1, 'type' => 1, 'id_patient_representative' => $id_patient_representative]) ?>">
                        <i class="fa fa-address-card"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-11 pr-0">
                    <?php $model->select2($form, 'id_patient_representative', $patient_list, 'Законный представитель'); ?>
                </div>
                <div class="col-1 ml-0 pl-0" style="top:32px">
                    <button class="btn btn-info btn-sm modalButton" type="button" title="Законный представитель" value="<?= Url::toRoute(['/patient/index', 'ajax' => 1, 'type' => 2, 'id_patient' => $id_patient]) ?>">
                        <i class="fa fa-address-card"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <?= $form->field($model, 'date_to')->widget(DatePicker::className(), [
                'options' => ['placeholder' => 'Дата начала'],
                'size' => 'sm',
                'pluginOptions' => [
                    'startDate' => date('d.m.Y', time()),
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ],
            ])->label();
            ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'date_do')->widget(DatePicker::className(), [
                'options' => ['placeholder' => 'Дата окончания'],
                'size' => 'sm',
                'pluginOptions' => [
                    'startDate' => date('d.m.Y', time()),
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ],
            ])->label();
            ?>
        </div>
        <div class="col-8">
            <?php echo $form->field($model, 'service')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Prices::find()->where(['is', 'deleted', new \yii\db\Expression('null')])->orderBy(['category' => SORT_ASC])->all(), 'id', 'service', 'category'),
                'size' => 'sm',
                'theme' => Select2::THEME_KRAJEE,
                'options' => ['placeholder' => 'Услуги', 'multiple' => true, 'autocomplete' => 'off'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'closeOnSelect' => false,
                ],
            ]);
            ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

        <?php if (Yii::$app->controller->action->id == 'update') : ?>
            <?=
            Html::a('Удалить', ['delete', 'id' => $_GET['id']], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                    'method' => 'post',
                    'autocomplete' => 'off',
                ],
            ])
            ?>
            <div class="dropdown float-right">
                <a class="btn btn-lg btn-secondary dropdown-toggle fs-8" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none !important;">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-word" viewBox="0 0 16 16" style="color:white ">
                            <path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z" />
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                        </svg>
                    </span>
                </a>
                <ul class="dropdown-menu fs-10">
                    <li><a class="dropdown-item" href="<?= Url::toRoute(['contract/download', 'id' => $id, 'type' => 1]) ?>">Взрослый договор платных услуг</a></li>
                    <li><a class="dropdown-item" href="<?= Url::toRoute(['contract/download', 'id' => $id, 'type' => 2]) ?>">Детский договор платных услуг</a></li>
                    <li><a class="dropdown-item" href="<?= Url::toRoute(['contract/download', 'id' => $id, 'type' => 3]) ?>">Согласие для детей</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>