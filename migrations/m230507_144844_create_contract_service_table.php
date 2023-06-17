<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contract_service}}`.
 */
class m230507_144844_create_contract_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contract_service}}', [
            'id' => $this->primaryKey(),
            'id_contract' => $this->smallInteger()->notNull()->comment('Договор'),
            'id_service' => $this->smallInteger()->notNull()->comment('Услуга'),
            'date_ct' => $this->smallInteger()->notNull()->comment('Дата'),
            'price' => $this->Integer()->notNull()->comment('Цена'),
            'name' => $this->text()->notNull()->comment('Наименование услуги'),
            'deleted' => $this->smallInteger()->null()->defaultValue(null)->comment('Видимость'),
        ]);
        //echo shell_exec("php yii gii/model --tableName=contract_service --modelClass=ContractService --interactive=0 --overwrite=1 --ns=app\\models");
        //echo shell_exec("php yii gii/crud --modelClass=app\\models\\ContractService --controllerClass=app\\controllers\ContractServiceController");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contract_service}}');
    }
}
