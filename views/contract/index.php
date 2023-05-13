<?php

use app\models\Contract;
use app\models\Patient;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var $model */

$patient = new Patient();
$patinet_list = $patient->PatientList;

?>
<div class="contract-index">
    <div class="contract-create">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-sm fs-10'
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'date_ct',
                'contentOptions' => ['class' => 'col-2'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel, 
                    'attribute' => 'date_ct_to',
                    'attribute2' => 'date_ct_do',
                    'type' => DatePicker::TYPE_RANGE,
                    'size' => 'sm',
                    'separator' => '-',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            ],
            [
                'attribute' => 'name',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            ],
            [
                'attribute' => 'patient_surname',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'table_class '],
                'value' => 'patient.surname',
                'label' => 'Фамилия',
            ],
            [
                'attribute' => 'patient_name',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'table_class '],
                'value' => 'patient.name',
                'label' => 'Имя',
            ],
            [
                'attribute' => 'patient_patronymic',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'table_class '],
                'value' => 'patient.patronymic',
                'label' => 'Отчество',
            ],
            [
                'attribute' => 'patient_brithday',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'table_class '],
                'value' => 'patient.brithday',
                'label' => 'Дата рождения',
            ],
            [
                'attribute' => 'patient_role',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'table_class '],
                'value' => 'patient.phone',
                'label' => 'Телефон',
            ],
            // [
            //     'attribute'=>'date_to',
            //     'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            // ],
            // [
            //     'attribute'=>'date_do',
            //     'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            // ],
            // [
            //     'attribute'=>'date_ct',
            //     'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            // ],
            // [
            //     'attribute'=>'id_patient_representative',
            //     'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            //     'contentOptions' =>['class' => 'table_class'],
            //     'content'=>function($data){
            //         return $data->representative->fullname;
            //     }
            // ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete} {download}',
                // 'urlCreator' => function ($action, Contract $model, $key, $index, $column) {
                //     return Url::toRoute([$action, 'id' => $model->id]);
                //  },
                //  'buttons' => [
                //     'update' => function ($url,$model) {
                //         return Html::a(
                //         '<span class="glyphicon glyphicon-screenshot">1</span>', 
                //         $url);
                //     },
                //     'link' => function ($url,$model,$key) {
                //         return Html::a('Действие', $url);
                //     },
                // ],
            ],
        ],
    ]); ?>


</div>