<?php

namespace app\models;

use PhpOffice\PhpWord\TemplateProcessor;
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
class Contract extends ModelInterface
{
    public $service;
    public $date_range;

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
            [['id_patient', 'id_patient_representative',  'name', 'deleted'], 'integer'],
            [['date_to', 'date_do', 'service', 'date_ct', 'date_range'], 'safe'],
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
            'deleted' => 'Видмость',
            'service' => 'Услуга',
        ];
    }

    public function afterFind()
    {
        $this->date_to = date('d.m.Y',$this->date_to);
        $this->date_do = date('d.m.Y',$this->date_do);
        $this->date_ct = date('d.m.Y',$this->date_ct);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date_to = strtotime($this->date_to);
            $this->date_do = strtotime($this->date_do);
            // $this->date_ct = strtotime($this->date_ct);
            // $this->date_ct = $this->date_ct ? strtotime($this->date_ct) : strtotime('now');
            return true;
        }
        return false;

    }


    public function getPatient()
	{
		return $this->hasOne(Patient::className(), ['id' => 'id_patient']);
	}
    public function getRepresentative()
	{
		return $this->hasOne(Patient::className(), ['id' => 'id_patient_representative']);
	}

    public function month(){
        return [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь'
          ];
    }
}
