<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContractService $model */

$this->title = 'Update Contract Service: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contract Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contract-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
