<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aty_patient}}`.
 */
class m230505_152556_create_aty_patient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aty_patient}}', [
            'id' => $this->primaryKey(),
            'surname' => $this->string(255)->notNull()->comment('Фамилия'),
            'name' => $this->string(255)->notNull()->comment('Имя'),
            'patronymic' => $this->string(255)->notNull()->comment('Отчество'),
            'fullname' => $this->string(255)->notNull()->comment('ФИО'),
            'address_city' => $this->string(255)->null()->defaultValue(null)->comment('Адрес. Населенный пункт'),
            'address_street' => $this->string(255)->null()->defaultValue(null)->comment('Адрес. Улица'),
            'address_home' => $this->string(255)->null()->defaultValue(null)->comment('Адрес. Дом'),
            'address_room' => $this->string(255)->null()->defaultValue(null)->comment('Адрес. Квартира'),
            'document' => $this->string(255)->notNull()->comment('Документ'),
            'passport_serial' => $this->string(255)->notNull()->comment('Серия'),
            'passport_number' => $this->string(255)->notNull()->comment('Номер'),
            'passport_issued' => $this->string(255)->notNull()->comment('Кем выдан'),
            'phone' => $this->string(255)->notNull()->comment('Телефон'),
            'parent_id' => $this->smallInteger()->defaultValue(null)->comment('Законный представитель'),
            'brithday' => $this->smallInteger()->defaultValue(null)->comment('Дата рождения'),
        ]);


        // echo shell_exec("php yii gii/model --tableName=aty_patient --modelClass=Patient --interactive=0 --overwrite=1 --ns=app\\models");
        // echo shell_exec("php yii gii/crud --modelClass=app\\models\\Patient --controllerClass=app\\controllers\PatientController");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%aty_patient}}');
    }
}
