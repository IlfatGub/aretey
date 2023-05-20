<style>
    .notify {
        max-width: 650px;
        bottom: 10px;
        right: 10px;
        position: fixed;
        z-index: 100;
    }
</style>


<?php if(Yii::$app->session->hasFlash('type_notify')): ?>
    <div class="notify">
    <div id="w1-danger" class="alert-<?=Yii::$app->session->getFlash('type_notify')?> alert alert-dismissible" role="alert">
        <!-- <div><?= $title ?> </div> -->
        <div class="fs-8"> <?= Yii::$app->session->getFlash(Yii::$app->session->getFlash('type_notify')) ?> </div>
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
    </div>
</div>

<?php
$script = <<< JS
    setTimeout(function(){
        $('#w1-danger').remove();
    },5000);
JS;
$this->registerJs($script);
?>

<?php 
Yii::$app->session->getFlash(Yii::$app->session->getFlash('type_notify'), null);
Yii::$app->session->setFlash('type_notify', null)
?>

<?php endif; ?>




