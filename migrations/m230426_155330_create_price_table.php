<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 */
class m230426_155330_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull()->comment('Наименование услуги'),
            'category' => $this->string(255)->notNull()->comment('Категория'),
            'code' => $this->string(255)->notNull()->comment('Код'),
            'time' => $this->string(255)->defaultValue(null)->comment('Срок'),
            'price' => $this->smallInteger()->defaultValue(null)->comment('Цена'),
            'count' => $this->smallInteger()->defaultValue(null)->comment('Количество'),
            'deleted' => $this->smallInteger()->defaultValue(null)->comment('Удален'),
            'id_type' => $this->smallInteger()->defaultValue(null)->comment('Тип услуги'),
            'id_biom' => $this->smallInteger()->defaultValue(null)->comment('Биоматериал'),
        ]);


        $this->insert('{{%price}}', [
            'name'=>'Лейкоцитарная формула (микроскопия)',
            'category'=>'6',
            'code'=>'11-10-004',
            'time'=>'1 р. д.',
            'price'=>'185',
            'id_type'=>'2',
            'id_biom'=>'6',
            ]
        );

        $this->insert('{{%price}}', [
            'name'=>'Тельца Гейнца',
            'category'=>'7',
            'code'=>'11-10-008',
            'time'=>'2 р. д.',
            'price'=>'200',
            'id_type'=>'1',
            'id_biom'=>'4',
            ]
        );

        echo shell_exec("php yii gii/model --tableName=price --modelClass=Prices --interactive=0 --overwrite=1 --ns=app\\models");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%price}}');
    }
}
