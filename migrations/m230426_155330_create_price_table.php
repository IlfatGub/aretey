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
            'code' => $this->string(255)->defaultValue(null)->comment('Код'),
            'time' => $this->string(255)->defaultValue(null)->comment('Срок'),
            'price' => $this->smallInteger()->defaultValue(null)->comment('Цена'),
            'count' => $this->smallInteger()->defaultValue(null)->comment('Количество'),
            'deleted' => $this->smallInteger()->defaultValue(null)->comment('Удален'),
            'type' => $this->text()->defaultValue(null)->comment('Тип услуги'),
            'biom' => $this->text()->defaultValue(null)->comment('Биоматериал'),
        ]);


        $this->insert('{{%price}}', [
            'name' => 'Прием (осмотр, консультация) врача-педиатра первичный',
            'category' => 'Педиатр',
            'price' => '800',
            ]
        );

        $this->insert('{{%price}}', [
            'name' => 'Прием (осмотр, консультация) врача-педиатра повторный (в течении 2х недель)',
            'category' => 'Педиатр',
            'price' => '750',
            ]
        );

        $this->insert('{{%price}}', [
            'name' => 'Прием врача с интерпретацией проведенного обследования без повторного осмотра ребенка, выдача справок (дет.сад, школа, бассейн, пионерлагерь и др.)',
            'category' => 'Педиатр',
            'price' => '390',
            ]
        );

        $this->insert('{{%price}}', [
            'name' => 'УЗИ брюшной полости (печень, селезенка, желчный пузырь, поджелудочная железа) (Натощак)',
            'category' => 'УЗИ Общесоматическое',
            'price' => '350',
            ]
        );

        $this->insert('{{%price}}', [
            'name' => 'Ультразвуковое исследование мочевого пузыря с определением остаточной мочи. (Полный мочевой пузырь)',
            'category' => 'УЗИ Общесоматическое',
            'price' => '152',
            ]
        );

        $this->insert('{{%price}}', [
            'name' => 'Ультразвуковое исследование поджелудочной железы . (Натощак)',
            'category' => 'УЗИ Общесоматическое',
            'price' => '1000',
            ]
        );

        $this->insert('{{%price}}', [
            'name' => 'Прием (осмотр, консультация) врача — детского эндокринолога первичный',
            'category' => 'Детский эндокринолог',
            'price' => '900',
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
