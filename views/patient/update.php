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
        <div class="card border-secondar">
            <div class="card-header">
                Договора
            </div>
            <div class="card-body ">
            <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Договор</th>
                    <th scope="col">Пациент</th>
                    <th scope="col">Дата начала</th>
                    <th scope="col">Дата окончания</th>
                    <th scope="col">-</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->getContract() as $item) : ?>
                    <tr>
                        <th scope="row"><?= $item->date_ct ?></th>
                        <td><?= Html::a($item->name, Url::toRoute(['contract/update', 'id' => $item->id])) ?></td>
                        <td><?= $item->patient->fullname ?></td>
                        <td><?= $item->date_to ?></td>
                        <td><?= $item->date_do ?></td>
                        <td><?= Html::a('
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-word" viewBox="0 0 16 16">
<path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z"/>
<path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
</svg>', Url::toRoute(['/contract/download', 'id' => $model->id])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
            </div>
        </div>
    <?php endif; ?>
</div>