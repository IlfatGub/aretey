<?php

namespace  app\components;

use yii\base\Widget;

class PatientNavbarWidget extends Widget
{
    public $model;

    public function init()
    {
        parent::init();
        if ($this->model === null) {
            $this->model = 0;
        }
    }

    public function run()
    {

        return $this->render(
            'patient-navbar',
            [
                'model' => $this->model,
            ]
        );
    }
}
