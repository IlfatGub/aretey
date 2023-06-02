<?php

use app\components\ContractNavbarWidget;
use app\components\NotifyWidget;
use app\components\PatientNavbarWidget;
use app\models\Contract;
use app\models\Patient;
use kartik\typeahead\Typeahead;
use yii\helpers\Html;
use yii\helpers\Url;

echo NotifyWidget::widget();
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= \yii\helpers\Url::home() ?>" class="nav-link">Главная</a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">1
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> -->

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user"></i>
                <!-- <span class="badge badge-danger navbar-badge">8</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php
                if(Patient::find()->exists()){
                    foreach(Patient::find()->limit(8)->all() as $item){
                        echo PatientNavbarWidget::widget(['model' => $item]);
                    }
                }
                ?>
                <a href="<?= Url::toRoute('/patient/index') ?>" class="dropdown-item dropdown-footer">Все пользователи</a>

            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-file-contract"></i>
                <!-- <span class="badge badge-warning navbar-badge">15</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php
                if(Contract::find()->exists()){
                    foreach(Contract::find()->limit(8)->all() as $item){
                        echo ContractNavbarWidget::widget(['model' => $item]);
                    }
                }
                ?>
                <a href="<?= Url::toRoute('/contract/index') ?>" class="dropdown-item dropdown-footer">Все договора</a>

            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
<!-- /.navbar -->