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
 * @property int|null $id_type Тип услуги
 * @property int|null $id_biom Биоматериал
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
            [['name', 'category', 'code'], 'required'],
            [['name'], 'string'],
            [['price', 'count', 'deleted', 'id_type', 'id_biom'], 'integer'],
            [['category', 'code', 'time'], 'string', 'max' => 255],
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
            'id_type' => 'Id Type',
            'id_biom' => 'Id Biom',
        ];
    }
}
