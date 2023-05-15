<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Patient $model */

?>
<div class="patient-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>




    <?php if ($model->existsContract()) : ?> 
        <hr><hr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <object type="text/html" data="<?= Url::toRoute(['/contract/index', 'ajax' => 1, 'patient_id' => $model->id]) ?>"></object>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>