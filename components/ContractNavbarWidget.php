<?php

namespace  app\components;

use yii\base\Widget;

class ContractNavbarWidget extends Widget
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
            'contract-navbar',
            [
                'model' => $this->model,
            ]
        );
    }
}
