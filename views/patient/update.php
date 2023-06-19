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
                                <?php if ($service->existsContractService()) : ?>
                                    <?php foreach ($service->getContratService() as $_item) : ?>
                                        <?php $summ += $_item->price; ?>
                                        <?php echo $_item->name . ' ' . '<b>' . $_item->price . '</b><br>' ?>
                                    <?php endforeach; ?>
                                    <?php echo "<b>Общая сумма:</b> " . $summ; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-secondary dropdown-toggle fs-8" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none !important;">
                                        <span> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-word" viewBox="0 0 16 16" style="color:white ">
                                                <path d="M5.485 6.879a.5.5 0 1 0-.97.242l1.5 6a.5.5 0 0 0 .967.01L8 9.402l1.018 3.73a.5.5 0 0 0 .967-.01l1.5-6a.5.5 0 0 0-.97-.242l-1.036 4.144-.997-3.655a.5.5 0 0 0-.964 0l-.997 3.655L5.485 6.88z" />
                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" /> 
                                            </svg>
                                            </span>
                                    </a>
                                    <ul class="dropdown-menu fs-10">
                                        <li><a class="dropdown-item" href="<?= Url::toRoute(['contract/download', 'id' => $item->id, 'type' => 1]) ?>">Взрослый договор платных услуг</a></li>
                                        <li><a class="dropdown-item" href="<?= Url::toRoute(['contract/download', 'id' => $item->id, 'type' => 2]) ?>">Детский договор платных услуг</a></li>
                                        <li><a class="dropdown-item" href="<?= Url::toRoute(['contract/download', 'id' => $item->id, 'type' => 3]) ?>">Согласие для детей</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </p>
        </div>


    <?php endif; ?>
</div>