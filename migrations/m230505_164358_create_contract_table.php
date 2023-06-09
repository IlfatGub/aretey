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
            'id_patient' => $this->smallInteger()->notNull()->comment('Пациент'),
            'id_patient_representative' => $this->smallInteger()->defaultValue(null)->comment('Законный представитель'),
            'date_to' => $this->integer()->null()->defaultValue(null)->comment('Дата начала'),
            'date_do' => $this->integer()->null()->defaultValue(null)->comment('Дата окончания'),
            'date_ct' => $this->integer()->notNull()->comment('Дата'),
            'summ' => $this->integer()->notNull()->comment('Сумма по договору'),
            'name' => $this->string(255)->notNull()->comment('Наименование договора'),
            'deleted' => $this->smallInteger()->null()->defaultValue(null)->comment('Видимость'),
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
