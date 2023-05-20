<?php

/** @var app\models\Patient $model */

use yii\helpers\Url;

?>
<!-- <div class="dropdown-divider"></div>
<a href="<?= Url::toRoute(['/patient/update' , 'id' => $model->id]) ?>" class="dropdown-item">
    <div class="media">
        <div class="media-body">
            <h3 class="dropdown-item-title">
                <?= $model->fullname ?>
                <span class="float-right text-sm text-danger"></i></span>
            </h3>
            <p class="text-sm"><?= $model->document . ': ' . $model->passport_serial . ' ' . $model->passport_number  ?></p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
        </div>
    </div>
</a> -->

<div class="dropdown-divider"></div>
<a href="<?= Url::toRoute(['/patient/update' , 'id' => $model->id]) ?>" class="dropdown-item">
    </i> <?= $model->surname.' '.mb_substr($model->name, 0, 1).'.'.mb_substr($model->patronymic, 0, 1).'.' ?>
    <span class="float-right text-muted text-sm"> <?= $model->passport_serial . ' ' . $model->passport_number ?> </span>
</a>