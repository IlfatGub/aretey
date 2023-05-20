<?php

/** @var app\models\Contract $model */

use yii\helpers\Url;
?>

<div class="dropdown-divider"></div>
<a href="<?= Url::toRoute(['/contract/update' , 'id' => $model->id]) ?>" class="dropdown-item">
    </i> <?= $model->patient->surname.' '.mb_substr($model->patient->name, 0, 1).'.'.mb_substr($model->patient->patronymic, 0, 1).'.' ?>
    <span class="float-right text-muted text-sm"> <?= $model->date_ct ?> </span>
</a>