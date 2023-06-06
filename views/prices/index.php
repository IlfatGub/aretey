<?php

use kartik\select2\Select2;
use kartik\typeahead\Typeahead;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

Pjax::begin();
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
            'class' => 'table table-hover table-bordered table-sm color-black'
        ],

        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['class' => $model->deleted ? 'bgr-red' : ''];
        },
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
            ],
            [
                'attribute' => 'name',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'col-7'],
                'headerOptions' => [],
                'content' => function ($data) {
                    return $data->getTextarea('name');
                }
            ],
            [
                'attribute' => 'category',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'category',
                    'size' => Select2::SMALL,
                    'data' =>  ArrayHelper::map($model::find()->distinct('category')->select('category')->orderBy(['category' => SORT_DESC])->all(), 'category', 'category'),
                    'options' => ['placeholder' => '', ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                // 'filter' =>  ArrayHelper::map($model::find()->distinct('category')->select('category')->orderBy(['category' => SORT_DESC])->all(), 'category', 'category'),
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'col-4'],
                'content' => function ($data) {
                    return $data->getTextarea('category');
                }
            ],
            [
                'attribute' => 'price',
                'filterInputOptions' => ['class' => 'form-control form-control-sm'],
                'contentOptions' => ['class' => 'col-1'],
                'content' => function ($data) {
                    return $data->getInput('price', 'number');
                }
            ],
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width:45px; text-align:center;'],
                'template' => ' {delete} ',
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

<?php Pjax::end(); ?>