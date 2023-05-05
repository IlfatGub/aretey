<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property int $id
 * @property int|null $id_patient Пациент
 * @property int|null $date_to Дата окончания
 * @property int|null $date_ct Дата
 * @property int|null $name Наименование договора
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_patient', 'date_to', 'date_ct', 'name'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_patient' => 'Id Patient',
            'date_to' => 'Date To',
            'date_ct' => 'Date Ct',
            'name' => 'Name',
        ];
    }
}
