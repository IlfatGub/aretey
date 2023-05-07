<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContractService $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contract-service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_contract')->textInput() ?>

    <?= $form->field($model, 'id_service')->textInput() ?>

    <?= $form->field($model, 'visible')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
