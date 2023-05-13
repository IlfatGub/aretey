<?php

use app\components\TypeheadWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Patient $model */
/** @var yii\widgets\ActiveForm $form */

// $id_patient = $_GET['id_patient'] ?? null;
$type = $_GET['type'] ?? null;
$ajax = $_GET['ajax'] ?? null;
// $id_patient_representative = $_GET['id_patient_representative'] ?? null;

$patient = $model::find()->all();
$city = $model->arrayFilter($patient, 'address_city');
$street = $model->arrayFilter($patient, 'address_street');
$document = $model->arrayFilter($patient, 'document');
$passport_issued = $model->arrayFilter($patient, 'passport_issued');
?>

<div class="patient-form <?= $ajax ? 'fs-8': ''?>">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => ''],
        'id' => 'patient-form',
        // 'enableAjaxValidation' => true,
    ]); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'placeholder' => 'Фамилия'])->label() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'placeholder' => 'Имя'])->label() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true,  'class' => 'form-control form-control-sm', 'placeholder' => 'Отчество'])->label() ?>
        </div>
        <div class="col">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'placeholder' => 'Телефон'])->label() ?>
            </div>
        <div class="col">
            <?php
            // Usage with model and Active Form (with no default initial value)
            echo $form->field($model, 'brithday')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Дата рождения'],
                'size' => 'sm',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ],
            ])->label();
            ?>
        </div>
    </div>

    <?php if ($type <> 2) : ?>
        <div class="row">
            <div class="col-4">
                <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'address_city', 'local' => $city, 'placeholder' => 'Населенный пункт']) ?>
            </div>
            <div class="col-4">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'address_street', 'local' => $street, 'placeholder' => 'Улица']) ?>
            </div>
            <div class="col-2">
                <?= $form->field($model, 'address_home')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'placeholder' => 'Дом'])->label() ?>
            </div>
            <div class="col-2">
                <?= $form->field($model, 'address_room')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'placeholder' => 'Квартира'])->label() ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-3">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'document', 'local' => $document, 'placeholder' => 'Документ']) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'passport_serial')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'placeholder' => 'Серия'])->label() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'placeholder' => 'Номер'])->label() ?>
        </div>
        <div class="col-5">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'passport_issued', 'local' => $passport_issued, 'placeholder' => 'Когда, кем выдано']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>