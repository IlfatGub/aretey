<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "contract_service".
 *
 * @property int $id
 * @property int $id_contract Договор
 * @property int $id_service Услуга
 * @property int|null $visible Видимость
 */
class ContractService extends ModelInterface
{
    public $service_list;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_contract', 'id_service'], 'required'],
            [['id_contract', 'id_service', 'visible'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_contract' => 'Id Contract',
            'id_service' => 'Id Service',
            'visible' => 'Visible',
        ];
    }

    public function getContract()
	{
		return $this->hasOne(Contract::className(), ['id' => 'id_contract']);
	}
    public function getPrice()
	{
		return $this->hasOne(Prices::className(), ['id' => 'id_service']);
	}
    public function getPrices()
	{
		return $this->hasOne(Prices::className(), ['id' => 'id_service']);
	}
    public function addService()
    {
        $this->deleteServiceForContract();
        foreach ($this->service_list as $items) {
            try {
                $_service = new ContractService();
                $_service->id_contract = $this->id_contract;
                $_service->id_service = $items;
                $_service->price = Prices::findOne($items)->price;
                $_service->visible = null;
                $_service->getSave();
            } catch (\Exception $ex) {
                echo '<pre>'; print_r($ex); echo '</pre>';
                die();
            }
        }
    }

    public function deleteServiceForContract(){
        if(self::find()->where(['id_contract' => $this->id_contract])->exists())
            return self::deleteAll(['id_contract' => $this->id_contract]);
    }

    public function getServieByContract(){
        return ArrayHelper::map(self::findAll(['id_contract' => $this->id_contract]), 'id', 'id_service');
    }


    /**
     * выводим услуги по договору
     */
    public function getContratService(){
        if(ContractService::find()->where(['id_contract' => $this->id_contract])->exists())
            return ContractService::find()->joinWith(['prices'])->where(['id_contract' => $this->id_contract])->all();
        return false;
    }
}
