<?php

use app\components\TypeheadWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

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
$name = $model->arrayFilter($patient, 'name');
$surname = $model->arrayFilter($patient, 'surname');
$patronymic = $model->arrayFilter($patient, 'patronymic');
?>

<div class="patient-form <?= $ajax ? 'fs-8' : '' ?>">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => ''],
        'id' => 'patient-form',
        // 'enableAjaxValidation' => true,
    ]); ?>

    <div class="row">
        <div class="col">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'surname', 'local' => $surname, 'placeholder' => 'Фамилия']) ?>
        </div>
        <div class="col">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'name', 'local' => $name, 'placeholder' => 'Имя']) ?>
        </div>
        <div class="col">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'patronymic', 'local' => $patronymic, 'placeholder' => 'Отчество']) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'placeholder' => 'Телефон'])->label() ?>
        </div>
        <div class="col">
            <?php
            // Usage with model and Active Form (with no default initial value)
            echo $form->field($model, 'brithday')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Дата рождения', 'autocomplete' => 'off',],
                'size' => 'sm',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                ],
            ])->label();
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'address_city', 'local' => $city, 'placeholder' => 'Населенный пункт']) ?>
        </div>
        <div class="col-4">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'address_street', 'local' => $street, 'placeholder' => 'Улица']) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'address_home')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'placeholder' => 'Дом'])->label() ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'address_room')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'placeholder' => 'Квартира'])->label() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'document', 'local' => $document, 'placeholder' => 'Документ']) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'passport_serial')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'placeholder' => 'Серия'])->label() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm', 'autocomplete' => 'off',  'placeholder' => 'Номер'])->label() ?>
        </div>
        <div class="col-5">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'passport_issued', 'local' => $passport_issued, 'placeholder' => 'Когда, кем выдано']) ?>
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
        <?php endif; ?>

    </div>
    <?php ActiveForm::end(); ?>

</div>