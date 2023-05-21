<?php

use app\models\ContractService;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Contract $model */
$id = $_GET['id'] ?? null;

$_cs = new ContractService(['id_contract' => $id]);

?>
<div class="contract-update">
  <?= $this->render('_form', [
    'model' => $model,
  ]) ?>

  <?php $p = $model->patient; ?>
  <?php $pe = $model->representative; ?>
  <hr>

  <div id="w0" class="callout callout-info">
    <table class="table table-sm table-bordered border-primary fs-10 mb-0" style="background: white;">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Пациент</th>
          <th scope="col">Законный представитель</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">ФИО</th>
          <td><?= Html::a($p->fullname, Url::toRoute(['/patient/update', 'id' => $p->id])) ?></td>
          <td><?= Html::a($pe->fullname, Url::toRoute(['/patient/update', 'id' => $pe->id])) ?></td>
        </tr>
        <tr>
          <th scope="row">Дата Рождения</th>
          <td><?= $p->brithday ?></td>
          <td><?= $pe->brithday ?></td>
        </tr>
        <tr>
          <th scope="row">Документ</th>
          <td><?= $p->address_city . ', ' . $p->address_street . ', ' . $p->address_home . ', ' . $p->address_room ?></td>
          <td><?= $pe->address_city ? $pe->address_city . ', ' . $pe->address_street . ', ' . $pe->address_home . ', ' . $pe->address_room : '' ?></td>
        </tr>
        <tr>
          <th scope="row">Адрес Регистрации</th>
          <td><?= $p->document . ': ' . $p->passport_serial . ' ' . $p->passport_number ?></td>
          <td><?= $pe->document ? $pe->document . ': ' . $pe->passport_serial . ' ' . $pe->passport_number : '' ?></td>
        </tr>
        <tr>
          <th scope="row">Телефон</th>
          <td><?= $p->phone ?></td>
          <td><?= $pe->phone ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <hr>


  <?php if ($_cs->existsContractService()) : ?>
    <div id="w0" class="callout callout-warning">
      <div class="">
        <table class="table table-sm table-bordered border-primary fs-10 mb-0" style="background: white;">
          <thead>
            <tr>
              <th scope="col">Категория</th>
              <th scope="col">Услуга</th>
              <th scope="col">Цена</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_cs->getContratService() as $item) : ?>
              <tr>
                <td><?= $item->prices->category ?></td>
                <td><?= $item->prices->name ?></td>
                <td><?= $item->price ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endif; ?>

</div>