<?php

namespace  app\components;

use yii\base\Widget;

class NotifyWidget extends Widget
{
    public $type;
    public $message;
    public $title;

    public function init()
    {
        parent::init();
        if ($this->title === null) {
            $this->title = 0;
        }
        if ($this->message === null) {
            $this->message = 0;
        }
        if ($this->type === null) {
            $this->type = 0;
        }
    }

    public function run()
    {

        return $this->render(
            'notify',
            [
                'title' => $this->title,
                'message' => $this->message,
                'type' => $this->type,
            ]
        );
    }
}
