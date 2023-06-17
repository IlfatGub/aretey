<?php

use app\models\ContractService;
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

        <div id="w0" class="callout callout-info">
            <h5>Договора</h5>
            <p>
            <table class="table table-hover table-striped fs-8">
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
                            <td>
                                <?php $service = new ContractService(['id_contract' => $item->id]); ?>
                                <?php foreach($service->getContratService() as $item): ?>
                                    <?php $summ += $item->price; ?>
                                    <?php echo $item->name. ' ' .'<b>'.$item->price .'</b><br>'?>
                                <?php endforeach; ?>
                                <?php echo "<b>Общая сумма:</b> ".$summ; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </p>
        </div>


    <?php endif; ?>
</div>