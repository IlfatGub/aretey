<?php

use app\models\Patient;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\PatientSearch $searchModel  */

?>
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
            'surname',
            'name',
            'patronymic',
            // 'fullname',
            'address_city',
            'address_street',
            'address_home',
            'address_room',
            'document',
            'passport_serial',
            'passport_number',
            'passport_issued',
            'phone',
            //'parent_id',
            [
                'attribute' => 'brithday',
                'content'=>function($data){
                    return $data->brithday.' ('.$data->age.')';
                },
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
