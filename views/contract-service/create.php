<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContractService $model */

$this->title = 'Create Contract Service';
$this->params['breadcrumbs'][] = ['label' => 'Contract Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
