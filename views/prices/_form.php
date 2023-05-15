<?php

use app\components\TypeheadWidget;
use kartik\typeahead\Typeahead;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Prices $model */
/** @var yii\widgets\ActiveForm $form */

$biom = $model::find()->distinct('biom')->select('biom')->column();
$type = $model::find()->distinct('type')->select('type')->column();
$category = $model::find()->distinct('category')->select('category')->column();

?>

<style>
    body {
        background: white !important;
    }
</style>


<div class="prices-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-5"><?= $form->field($model, 'name')->textInput(['class' => 'form-control form-control-sm']) ?></div>
        <div class="col-3">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'category', 'local' => $category, 'placeholder' => 'Категория']) ?>
        </div>
        <div class="col-3"><?= $form->field($model, 'price')->textInput(['type' => 'number', 'class' => 'form-control  form-control-sm']) ?></div>
        <div class="col-1">
            <label for="" style="color:inherit !important"> - </label>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
<hr>
    <!-- <div class="row">
        <div class="col"><?= $form->field($model, 'code')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?></div>
        <div class="col"><?= $form->field($model, 'time')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?></div>
        <div class="col"><?= $form->field($model, 'price')->textInput(['type' => 'number', 'class' => 'form-control form-control-sm']) ?></div>
        <div class="col">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'type', 'local' => $type, 'placeholder' => 'Тип']) ?>
        </div>
        <div class="col">
            <?= TypeheadWidget::widget(['form' => $form, 'model' => $model, 'field' => 'biom', 'local' => $biom, 'placeholder' => 'Биоматераил']) ?>
        </div>
        <div class="col">
            <label for="" style="color:inherit !important"> - </label>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div> -->



    <?php ActiveForm::end(); ?>

</div>