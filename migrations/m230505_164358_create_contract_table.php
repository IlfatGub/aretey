<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contract}}`.
 */
class m230505_164358_create_contract_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contract}}', [
            'id' => $this->primaryKey(),
            'id_patient' => $this->smallInteger()->defaultValue(null)->comment('Пациент'),
            'date_to' => $this->smallInteger()->defaultValue(null)->comment('Дата начала'),
            'date_to' => $this->smallInteger()->defaultValue(null)->comment('Дата окончания'),
            'date_ct' => $this->smallInteger()->defaultValue(null)->comment('Дата'),
            'name' => $this->smallInteger()->defaultValue(null)->comment('Наименование договора'),
        ]);

        // echo shell_exec("php yii gii/model --tableName=contract --modelClass=Contract --interactive=0 --overwrite=1 --ns=app\\models");
        // echo shell_exec("php yii gii/crud --modelClass=app\\models\\Contract --controllerClass=app\\controllers\ContractController");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contract}}');
    }
}
