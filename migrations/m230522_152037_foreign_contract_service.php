<?php

use yii\db\Migration;

/**
 * Class m230522_152037_foreign_contract_service
 */
class m230522_152037_foreign_contract_service extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // $this->addForeignKey(
        //     'fk-price-service',
        //     'price',
        //     'id',
        //     'contract_service',
        //     'id_service',
        //     'CASCADE'
        // );

        // $this->addForeignKey(
        //     'fk-contract-service',
        //     'contract',
        //     'id',
        //     'contract_service',
        //     'id_contract',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230522_152037_foreign_contract_service cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230522_152037_foreign_contract_service cannot be reverted.\n";

        return false;
    }
    */
}
