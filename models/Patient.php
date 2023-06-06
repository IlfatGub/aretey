<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "patient".
 *
 * @property int $id
 * @property string $surname Фамилия
 * @property string $name Имя
 * @property string $patronymic Отчество
 * @property string $fullname ФИО
 * @property string|null $address_city Адрес. Населенный пункт
 * @property string|null $address_street Адрес. Улица
 * @property string|null $address_home Адрес. Дом
 * @property string|null $address_room Адрес. Квартира
 * @property string $document Документ
 * @property string $passport_serial Серия
 * @property string $passport_number Номер
 * @property string $passport_issued Кем выдан
 * @property string $phone Телефон
 * @property int|null $parent_id Законный представитель
 * @property int|null $brithday Дата рождения
 */
class Patient extends ModelInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'patronymic', 'document', 'passport_serial', 'passport_number', 'passport_issued', 'brithday'], 'required'],
            [['parent_id'], 'integer'],
            [['brithday'], 'safe'],
            [['surname', 'name', 'patronymic', 'fullname', 'address_city', 'address_street', 'address_home', 'address_room', 'document', 'passport_serial', 'passport_number', 'passport_issued', 'phone'], 'string', 'max' => 255],
            [['passport_serial', 'passport_number'], 'unique', 'targetAttribute' => ['passport_serial', 'passport_number']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'fullname' => 'ФИО',
            'address_city' => 'Населенный пункт',
            'address_street' => 'Улица',
            'address_home' => 'Дом',
            'address_room' => 'Квартира',
            'document' => 'Документ',
            'passport_serial' => 'Серия',
            'passport_number' => 'Номер',
            'passport_issued' => 'Когда, кем выдан',
            'phone' => 'Телефон',
            'parent_id' => '',
            'brithday' => 'Дата рождения',
        ];
    }

    public function afterFind()
    {
        $this->brithday = date('d.m.Y',$this->brithday);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->brithday = strtotime($this->brithday);
            return true;
        }
        return false;

    }

    public function getPatient(){
        return $this->fullname.'. '.$this->passport_serial.'  '.$this->passport_number;
    }

    public function getPatientList(){
        return ArrayHelper::map($this::find()->where(['deleted' => null])->all(), 'id', 'fullname');
    }

    public function arrayFilter($data, $field){
        $_var = ArrayHelper::map($data, 'id', $field);
        $_var = array_unique(array_filter($_var, static function($var){return $var !== null;}));
        sort($_var);
        return $_var;
    }

    public function existsContract(){
        return Contract::find()->where(['id_patient' => $this->id])->andFilterWhere(['is', 'deleted', new \yii\db\Expression('null')])->exists();
    }

    public function getContract(){
        return Contract::find()->where(['id_patient' => $this->id])->all();
    }

    public function getAge(){
        $borndate = strtotime($this->brithday);
        $date = strtotime('now');
        if (date('m', $borndate) > date('m', $date) || date('m', $borndate) == date('m', $date) && date('d', $borndate) > date('d')) {
            return (date('Y', $date) - date('Y', $borndate) - 1); // если в текущем году я ещё не отмечал День рождение, вернуть значение на 1 меньше
        }
        return (date('Y', $date) - date('Y', $borndate));
    }
    
}
