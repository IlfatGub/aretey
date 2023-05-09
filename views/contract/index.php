<?php

use app\models\Contract;
use app\models\Patient;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
// use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var $model */

$patient = new Patient();
$patinet_list = $patient->PatientList;
?>
<div class="contract-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                'attribute'=>'name',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            ],
            [
                'attribute'=>'id_patient',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' =>['class' => 'table_class'],
                'content'=>function($data){
                    return $data->patient->fullname;
                }
            ],
            [
                'attribute'=>'date_to',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            ],
            [
                'attribute'=>'date_do',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            ],
            [
                'attribute'=>'date_ct',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            ],
            [
                'attribute'=>'id_patient_representative',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' =>['class' => 'table_class'],
                'content'=>function($data){
                    return $data->representative->fullname;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => ' {update} {delete} {link}',
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