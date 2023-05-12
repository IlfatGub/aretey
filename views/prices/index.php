<?php

use app\components\TexareaWidget;
use app\models\Prices;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="prices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-striped table-sm fs-10'
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute'=>'name',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'col-4'],
                'headerOptions' => [],
                'content'=>function($data){
                    return $data->getTextarea('name');
                }
            ],
            [
                'attribute'=>'category',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'col-2'],
                'content'=>function($data){
                    return $data->getTextarea('category');
                }
            ],
            [
                'attribute'=>'code',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'content'=>function($data){
                    return $data->getInput('code');
                }
            ],
            [
                'attribute'=>'time',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'content'=>function($data){
                    return $data->getInput('time');
                }
            ],
            [
                'attribute'=>'price',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'content'=>function($data){
                    return $data->getInput('price');
                }
            ],
            [
                'attribute'=>'type',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'content'=>function($data){
                    return $data->getInput('type');
                }
            ],
            [
                'attribute'=>'biom',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'content'=>function($data){
                    return $data->getInput('biom');
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
