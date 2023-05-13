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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            'brithday',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Patient $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php endif ?>
</div>
