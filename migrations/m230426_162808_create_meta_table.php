<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meta}}`.
 */
class m230426_162808_create_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%meta}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull()->comment('Наименование'),
            'deleted' => $this->smallInteger()->defaultValue(null)->comment('Удален'),
            'type' => $this->smallInteger()->notNull()->comment('Тип'),
        ]);

        $this->insert('{{%meta}}', array('name'=>'кач','type'=>'1'));
        $this->insert('{{%meta}}', array('name'=>'колич','type'=>'1'));
        $this->insert('{{%meta}}', array('name'=>'кач/ полукоч','type'=>'1'));

        $this->insert('{{%meta}}', array('name'=>'Сыворотка крови','type'=>'2'));
        $this->insert('{{%meta}}', array('name'=>'Венозная кровь','type'=>'2'));
        $this->insert('{{%meta}}', array('name'=>'Сыворотка крови; Плазма крови','type'=>'2'));

        echo shell_exec("php yii gii/model --tableName=meta --modelClass=Meta --interactive=0 --overwrite=1 --ns=app\\models");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meta}}');
    }
}
