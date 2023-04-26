<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meta".
 *
 * @property int $id
 * @property string $name Наименование
 * @property int|null $deleted Удален
 * @property int $type Тип
 */
class Meta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name'], 'string'],
            [['deleted', 'type'], 'integer'],
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
            'deleted' => 'Deleted',
            'type' => 'Type',
        ];
    }
}
