<style>
    .notify {
        max-width: 650px;
        bottom: 10px;
        right: 10px;
        position: fixed;
        z-index: 100;
    }
</style>

<div class="notify">
    <div id="w1-danger" class="alert-<?= $type ?> alert alert-dismissible" role="alert">
        <!-- <div><?= $title ?> </div> -->
        <div class="fs-8"> <?= $message ?> </div>
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