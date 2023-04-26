<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prices_analyses}}`.
 */
class m230426_155330_create_prices_analyses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prices_analyses}}', [
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

        echo shell_exec("php yii gii/model --tableName=prices_analyses --modelClass=PricesAnalyses --interactive=0 --overwrite=1 --ns=app\\models");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prices_analyses}}');
    }
}
