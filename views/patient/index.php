<?php

use app\models\Patient;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\PatientSearch $searchModel  */

$fullname = ArrayHelper::map($model::find()->distinct('fullname')->select('fullname')->orderBy(['fullname' => SORT_DESC])->all(), 'fullname', 'fullname');
$address_city = ArrayHelper::map($model::find()->distinct('address_city')->select('address_city')->orderBy(['address_city' => SORT_DESC])->all(), 'address_city', 'address_city');
$address_street = ArrayHelper::map($model::find()->distinct('address_street')->select('address_street')->orderBy(['address_street' => SORT_DESC])->all(), 'address_street', 'address_street');
$document = ArrayHelper::map($model::find()->distinct('document')->select('document')->orderBy(['document' => SORT_DESC])->all(), 'document', 'document');

?>


<style>
.select2-results__options{
        font-size:12px !important;
        color:black !important;
 }
 </style>

<div class="patient-index">

    <div class="patient-create">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    
    <?php if(!$_GET['ajax']): ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-sm cl-black fs-8'
        ],
        'columns' => [
            // 'id',
            [
                'attribute' => 'fullname',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'fullname',
                    'size' => Select2::SMALL,
                    'data' =>  $fullname,
                    'options' => ['placeholder' => '', 'class' =>'fs-8'],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true
                    ],
                ]),
                // 'filter' =>  ArrayHelper::map($model::find()->distinct('category')->select('category')->orderBy(['category' => SORT_DESC])->all(), 'category', 'category'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
                'contentOptions' => ['class' => 'col-2'],
            ],

            // 'name',
            // 'patronymic',
            // 'fullname',
            [
                'attribute' => 'address_city',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'address_city',
                    'size' => Select2::SMALL,
                    'data' =>  $address_city,
                    'options' => ['placeholder' => '', 'class' =>'fs-8'],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true
                    ],
                ]),
                // 'filter' =>  ArrayHelper::map($model::find()->distinct('category')->select('category')->orderBy(['category' => SORT_DESC])->all(), 'category', 'category'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
                'contentOptions' => ['class' => 'col-1'],
            ],
            [
                'attribute' => 'address_street',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'address_street',
                    'size' => Select2::SMALL,
                    'data' =>  $address_street,
                    'options' => ['placeholder' => '', 'class' =>'fs-8'],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true
                    ],
                ]),
                // 'filter' =>  ArrayHelper::map($model::find()->distinct('category')->select('category')->orderBy(['category' => SORT_DESC])->all(), 'category', 'category'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
                'contentOptions' => ['class' => 'col-1'],
            ],
            [
                'attribute' => 'address_home',
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
            ],
            [
                'attribute' => 'address_room',
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
            ],
            [
                'attribute' => 'document',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'document',
                    'size' => Select2::SMALL,
                    'data' =>  $document,
                    'options' => ['placeholder' => '', 'class' =>'fs-8'],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true
                    ],
                ]),
                // 'filter' =>  ArrayHelper::map($model::find()->distinct('category')->select('category')->orderBy(['category' => SORT_DESC])->all(), 'category', 'category'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
                'contentOptions' => ['class' => 'col-1'],
            ],
            [
                'attribute' => 'passport_serial',
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
            ],
            [
                'attribute' => 'passport_number',
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
            ],
            [
                'attribute' => 'passport_issued',
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
            ],
            [
                'attribute' => 'phone',
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
            ],
            //'parent_id',
            [
                'attribute' => 'brithday',
                'content'=>function($data){
                    return $data->brithday.' ('.$data->age.')';
                },
                'filterInputOptions' => ['class' => 'form-control form-control-sm fs-8'],
            ],
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width:20px;'],
                'template' => '{update}',
            ],
        ],
    ]); ?>
    <?php endif ?>
</div>
