<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property int $id
 * @property int $id_patient Пациент
 * @property int|null $id_patient_representative Законный представитель
 * @property int|null $date_to Дата начала
 * @property int|null $date_do Дата окончания
 * @property int $date_ct Дата
 * @property int $name Наименование договора
 * @property int|null $visible Видимость
 * @property int|null $service Услуга
 */
class Contract extends \yii\db\ActiveRecord
{

    public $service;
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
            [['id_patient', 'date_ct', 'name'], 'required'],
            [['id_patient', 'id_patient_representative', 'date_to', 'date_do', 'date_ct', 'name', 'visible', 'service'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_patient' => 'Пациент',
            'id_patient_representative' => 'Законный представитель',
            'date_to' => 'Дата начала',
            'date_do' => 'Дата окончания',
            'date_ct' => 'Дата создания',
            'name' => 'Договора №',
            'visible' => 'Видмость',
            'service' => 'Услуга',
        ];
    }
}
