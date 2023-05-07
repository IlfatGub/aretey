<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract_service".
 *
 * @property int $id
 * @property int $id_contract Договор
 * @property int $id_service Услуга
 * @property int|null $visible Видимость
 */
class ContractService extends \yii\db\ActiveRecord
{
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
}
