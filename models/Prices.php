<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property string $name Наименование услуги
 * @property string $category Категория
 * @property string $code Код
 * @property string|null $time Срок
 * @property int|null $price Цена
 * @property int|null $count Количество
 * @property int|null $deleted Удален
 * @property string $type Тип услуги
 * @property string $biom Биоматериал
 */
class Prices extends ModelInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category'], 'required'],
            [['name', 'type', 'biom'], 'string'],
            [['price', 'count', 'deleted'], 'integer'],
            [['category', 'code', 'time'], 'string', 'max' => 255],
            // [['code'], 'unique'],
            [['name', 'category'], 'unique', 'targetAttribute' => ['name', 'category']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'category' => 'Категория',
            'code' => 'Код',
            'time' => 'Время',
            'price' => 'Цена',
            'count' => 'Количество',
            'deleted' => 'Deleted',
            'type' => 'Тип услуги',
            'biom' => 'Биоматериал',
        ];
    }

    public function getService(){
        return $this->category.' - '.$this->name;
        // return $this->name;
    }

    public function getTextarea($filed){
        return Html::textarea($filed, $this->$filed, ['rows' => 1, 'class' => 'form-control form-control-sm  inherit border-none',
        'onchange' => '$.post(" '.Url::toRoute(['edit-field']).'?id='.$this->id.'&field='.$filed.'&value='.'"+encodeURIComponent($(this).val()));']);
    }

    public function getInput($filed){
        return Html::input($filed == 'time' ? 'times' : $filed, 'string', $this->$filed, ['class' => 'form-control form-control-sm inherit border-none',
        'onchange' => '$.post(" '.Url::toRoute(['edit-field']).'?id='.$this->id.'&field='.$filed.'&value='.'"+encodeURIComponent($(this).val()));'
    ]);
    }
}
