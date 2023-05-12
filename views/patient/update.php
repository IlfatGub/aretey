<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Patient $model */

?>
<div class="patient-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
