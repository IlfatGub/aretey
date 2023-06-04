<?php

use app\models\Contract;
use app\models\Patient;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use kartik\export\ExportMenu;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var $model */

$patient = new Patient();
$patinet_list = $patient->PatientList;

$ajax = $_GET['ajax'] ?? null;
?>
<?php if($ajax): ?>
<style>
    .summary{
        display: none !important;
    }
</style>
<?php endif; ?>


<div class="contract-index">
    <?php if(!$ajax): ?>
    <div class="contract-create">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    <?php endif; ?>

    <?php 

    $column =  [
        // ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'date_ct',
            'contentOptions' => ['class' => 'col-2'],
            // 'filter' => DatePicker::widget([
            //     'model' => $searchModel,
            //     'attribute' => 'date_ct_to',
            //     'attribute2' => 'date_ct_do',
            //     'type' => DatePicker::TYPE_RANGE,
            //     'size' => 'sm',
            //     'separator' => '-',
            //     'pluginOptions' => [
            //         'autoclose' => true,
            //         'format' => 'yyyy-mm-dd'
            //     ]
            // ]),
            'filter' =>  DateRangePicker::widget([
                'model' => $searchModel,
                'name'=>'date_range',
                'attribute' => 'date_range',
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'locale'=>['format'=>'Y-m-d', 'separator'=>'/']
                ]
            ]),
            'filterInputOptions' => ['class' => 'form-control form-control-sm'],
        ],
        [
            'attribute' => 'name',
            'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            'content'=>function($data){
                return Html::a($data->name, Url::toRoute(['update', 'id' => $data->id]))  ;
            },
        ],
        // [
        //     'attribute' => 'patient_surname',
        //     'filterInputOptions' => ['class' => 'form-control form-control-sm'],
        //     'contentOptions' => ['class' => 'table_class '],
        //     'value' => 'patient.surname',
        //     'label' => 'Фамилия',
        // ],
        // [
        //     'attribute' => 'patient_name',
        //     'filterInputOptions' => ['class' => 'form-control form-control-sm'],
        //     'contentOptions' => ['class' => 'table_class '],
        //     'value' => 'patient.name',
        //     'label' => 'Имя',
        // ],
        // [
        //     'attribute' => 'patient_patronymic',
        //     'filterInputOptions' => ['class' => 'form-control form-control-sm'],
        //     'contentOptions' => ['class' => 'table_class '],
        //     'value' => 'patient.patronymic',
        //     'label' => 'Отчество',
        // ],
        [
            'attribute' => 'patient_fullname',
            'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            'contentOptions' => ['class' => 'table_class col-3'],
            'value' => 'patient.fullname',
            'content'=>function($data){
                return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box mr-2 cl-black" viewBox="0 0 16 16">
                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              </svg>', Url::toRoute(['patient/update', 'id' => $data->id_patient])).$data->patient->fullname  ;
            },
            'label' => 'ФИО',
        ],            
        [
            'attribute' => 'patient_brithday',
            'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            'contentOptions' => ['class' => 'table_class '],
            'value' => 'patient.brithday',
            'label' => 'Дата рождения',
            'content'=>function($data){
                return $data->patient->brithday.' ('.$data->patient->age.')';
            },
        ],
        [
            'attribute' => 'patient_role',
            'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            'contentOptions' => ['class' => 'table_class '],
            'value' => 'patient.phone',
            'label' => 'Телефон',
        ],
        [
            'attribute'=>'date_to',
            'filterInputOptions' => ['class' => 'form-control form-control-sm'],
        ],
        [
            'attribute'=>'date_do',
            'filterInputOptions' => ['class' => 'form-control form-control-sm'],
        ],
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
            'contentOptions' => ['style' => 'width:25px;'],
            'template' => '{download}',
            'urlCreator' => function ($action, Contract $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
            'buttons' => [
//                 'download' => function ($url, $model, $key) {
//                     return Html::a('
//                     <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-word" viewBox="0 0 16 16">
// <path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
// <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
// </svg>', Url::toRoute(['contract/download', 'id' => $model->id]));
//                 },
                'download' => function ($url, $model, $key) {
                    return '<div class="dropdown">
                    <a class="btn btn-sm btn-secondary dropdown-toggle fs-8" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-word" viewBox="0 0 16 16">
                       <path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
                       <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/> </span>
                    </a>
                    <ul class="dropdown-menu fs-10">
                      <li><a class="dropdown-item" href="'.Url::toRoute(['contract/download', 'id' => $model->id, 'type' => 1]).'">Взрослый договор платных услуг</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="'.Url::toRoute(['contract/download', 'id' => $model->id, 'type' => 2]).'">Детский договор платных услуг</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="'.Url::toRoute(['contract/download', 'id' => $model->id, 'type' => 3]).'">Согласие для детей</a></li>
                    </ul>
                  </div>';
                },
            ],
        ],
    ];

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => !$ajax ? $searchModel : null,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-sm fs-10'
        ],
        'columns' => $column,
    ]); 
    
    // Renders a export dropdown menu
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $column
    ]);

    ?>

    
</div>