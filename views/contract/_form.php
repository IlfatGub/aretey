<?php

use app\models\Patient;
use app\models\Prices;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contract $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contract-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col"><?= $form->field($model, 'name')->textInput([ 'class' => 'form-control form-control-sm','value' => strtotime('now')]) ?> </div>
        <div class="col">
            <?php
            echo $form->field($model, 'date_to')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Дата начала'],
                'size' => 'sm',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ],
            ])->label();
            ?>
        </div>
        <div class="col">
            <?php
            echo $form->field($model, 'date_do')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Дата окончания'],
                'size' => 'sm',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ],
            ])->label();
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'id_patient')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Patient::find()->orderBy(['fullname' => SORT_ASC])->all(), 'id', 'patient'),
                'options' => ['placeholder' => 'Пациент'],
                'size' => 'sm',
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'id_patient_representative')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Patient::find()->orderBy(['fullname' => SORT_ASC])->all(), 'id', 'patient'),
                'options' => ['placeholder' => 'Пациент'],
                'size' => 'sm',
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'service')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Prices::find()->orderBy(['category' => SORT_ASC])->all(), 'id', 'service'),
                'options' => ['placeholder' => 'Услуга'],
                'size' => 'sm',
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>