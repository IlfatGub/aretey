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
            'code' => $this->string(255)->notNull()->unique()->comment('Код'),
            'time' => $this->string(255)->defaultValue(null)->comment('Срок'),
            'price' => $this->smallInteger()->defaultValue(null)->comment('Цена'),
            'count' => $this->smallInteger()->defaultValue(null)->comment('Количество'),
            'deleted' => $this->smallInteger()->defaultValue(null)->comment('Удален'),
            'type' => $this->text()->notNull()->comment('Тип услуги'),
            'biom' => $this->text()->notNull()->comment('Биоматериал'),
        ]);


        $this->insert('{{%price}}', [
            'name'=>'ПРОФИЛЬ Клинический (общий) анализ крови (CBC, 5-Diff) с микроскопией мазка крови при выявлении патологических изменений + СОЭ',
            'category'=>'ГЕМАТОЛОГИЧЕСКИЕ ИССЛЕДОВАНИЯ',
            'code'=>'11-10-004',
            'time'=>'1 р. д.',
            'price'=>'185',
            'type'=>'колич',
            'biom'=>'Венозная кровь',
            ]
        );

        $this->insert('{{%price}}', [
            'name'=>'Лейкоцитарная формула (микроскопия)',
            'category'=>'ГЕМАТОЛОГИЧЕСКИЕ ИССЛЕДОВАНИЯ',
            'code'=>'11-10-003',
            'time'=>'1 р. д.',
            'price'=>'185',
            'type'=>'колич',
            'biom'=>'Венозная кровь',
            ]
        );

        $this->insert('{{%price}}', [
            'name'=>'Осмотическая стойкость эритроцитов (анемии)',
            'category'=>'ГЕМАТОЛОГИЧЕСКИЕ ИССЛЕДОВАНИЯ',
            'code'=>'11-10-002',
            'time'=>'1 р. д.',
            'price'=>'185',
            'type'=>'колич',
            'biom'=>'Венозная кровь',
            ]
        );


        $this->insert('{{%price}}', [
            'name'=>'Аллоиммунные антиэритроцитарные антитела (в непрямой реакции Кумбса, включая антирезус Ат)',
            'category'=>'ИММУНОГЕМАТОЛОГИЯ',
            'code'=>'12-10-006',
            'time'=>'1 р. д.',
            'price'=>'185',
            'type'=>'колич',
            'biom'=>'Венозная кровь',
            ]
        );

        $this->insert('{{%price}}', [
            'name'=>'Антигены системы Kell',
            'category'=>'ИММУНОГЕМАТОЛОГИЯ',
            'code'=>'12-10-010',
            'time'=>'1 р. д.',
            'price'=>'185',
            'type'=>'колич',
            'biom'=>'Венозная кровь',
            ]
        );

        // echo shell_exec("php yii gii/model --tableName=price --modelClass=Prices --interactive=0 --overwrite=1 --ns=app\\models");
        // echo shell_exec("php yii gii/crud --modelClass=app\\models\\Prices --controllerClass=app\\controllers\PricesController");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%price}}');
    }
}
