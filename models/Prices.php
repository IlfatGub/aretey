<?php

namespace app\models;

use Yii;

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
class Prices extends \yii\db\ActiveRecord
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
            [['name', 'category', 'code', 'type', 'biom'], 'required'],
            [['name', 'type', 'biom'], 'string'],
            [['price', 'count', 'deleted'], 'integer'],
            [['category', 'code', 'time'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category' => 'Category',
            'code' => 'Code',
            'time' => 'Time',
            'price' => 'Price',
            'count' => 'Count',
            'deleted' => 'Deleted',
            'type' => 'Type',
            'biom' => 'Biom',
        ];
    }

    public function getService(){
        // return $this->category.'. '.$this->name;
        return $this->name;
    }
}
