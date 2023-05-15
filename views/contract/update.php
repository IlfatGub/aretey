<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Contract $model */
?>
<div class="contract-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php $p = $model->patient; ?>
<?php $pe = $model->representative; ?>
<hr>
<table class="table table-sm table-bordered border-primary" style="background: white;">
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
      <td><?= $p->fullname ?></td>
      <td><?= $pe->fullname ?></td>
    </tr>
    <tr>
      <th scope="row">Дата Рождения</th>
      <td><?= $p->brithday ?></td>
      <td><?= $pe->brithday ?></td>
    </tr>
    <tr>
      <th scope="row">Адрес Регистрации</th>
      <td><?= $p->address_city.', '. $p->address_street.', '. $p->address_home.', '.$p->address_room ?></td>
      <td><?= $pe->address_city ? $pe->address_city.', '. $pe->address_street.', '. $pe->address_home.', '.$pe->address_room : ''?></td>
    </tr>
    <tr>
      <th scope="row">Адрес Регистрации</th>
      <td><?= $p->document.': '.$p->passport_serial.' '.$p->passport_number ?></td>
      <td><?= $pe->document ? $pe->document.': '.$pe->passport_serial.' '.$pe->passport_number : '' ?></td>
    </tr>
    <tr>
      <th scope="row">Телефон</th>
      <td><?= $p->phone ?></td>
      <td><?= $pe->phone ?></td>
    </tr>
  </tbody>
</table>

</div>