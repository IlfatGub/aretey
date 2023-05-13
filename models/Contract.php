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
            [['id_patient', 'id_patient_representative',  'name', 'visible'], 'integer'],
            [['date_to', 'date_do', 'service', 'date_ct'], 'safe'],
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

    public function afterFind()
    {
        $this->date_to = date('Y-m-d',$this->date_to);
        $this->date_do = date('Y-m-d',$this->date_do);
        $this->date_ct = date('Y-m-d H:i:s',$this->date_ct);
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
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь'
          ];
    }
}
