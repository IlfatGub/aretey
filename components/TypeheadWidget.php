<?php

namespace  app\components;

use yii\base\Widget;

class TypeheadWidget extends Widget
{
    public $model;
    public $local;
    public $placeholder;
    public $field;
    public $form;

    public function init()
    {
        parent::init();
        if ($this->model === null) {
            $this->model = 0;
        }
        if ($this->local === null) {
            $this->local = 0;
        }
        if ($this->placeholder === null) {
            $this->placeholder = 0;
        }
        if ($this->field === null) {
            $this->field = 0;
        }
        if ($this->form === null) {
            $this->form = 0;
        }
    }

    public function run()
    {

        return $this->render(
            'typehead',
            [
                'model' => $this->model,
                'local' => $this->local,
                'placeholder' => $this->placeholder,
                'field' => $this->field,
                'form' => $this->form,
            ]
        );
    }
}
