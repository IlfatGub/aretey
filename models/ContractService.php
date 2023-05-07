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

    public function addService()
    {
        $this->deleteServiceForContract();

        foreach ($this->service_list as $items) {
            $_service = new ContractService();
            $_service->id_contract = $this->id_contract;
            $_service->id_service = $items;
            $_service->visible = null;
            $_service->getSave();
        }
    }

    public function deleteServiceForContract(){
        if(self::find()->where(['id_contract' => $this->id_contract])->exists())
            return self::deleteAll(['id_contract' => $this->id_contract]);
    }

    public function getServieByContract(){
        return ArrayHelper::map(self::findAll(['id_contract' => $this->id_contract]), 'id', 'id_service');
    }
}
