<?php

use yii\db\Migration;

/**
 * Class m230506_172324_generate_patient_value
 */
class m230506_172324_generate_patient_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%patient}}', [
            'id' => '',
            'surname' => 'Ермолай',
            'name' => 'Костин',
            'patronymic' => 'Тимофеевич',
            'fullname' => 'Костин Ермолай Тимофеевич',
            'address_city' => 'г. Уфа',
            'address_street' => 'ул. Уфимская',
            'address_home' => '25',
            'address_room' => '98',
            'document' => 'Паспорт',
            'passport_serial' => '8080',
            'passport_number' => '282828',
            'passport_issued' => 'УФМС г.Уфа',
            'phone' => '+79878888888',
            'parent_id' => '',
            'brithday' => '05.05.1989',
            'visible' => null,
            ]
        );

        $this->insert('{{%patient}}', [
            'id' => '',
            'surname' => 'Данилов',
            'name' => 'Евгений',
            'patronymic' => 'Семенович',
            'fullname' => 'Данилов Евгений Семенович',
            'address_city' => 'г. Салават',
            'address_street' => 'ул. Калинина',
            'address_home' => '125',
            'address_room' => '198',
            'document' => 'Паспорт',
            'passport_serial' => '8081',
            'passport_number' => '282828',
            'passport_issued' => 'УФМС г.Салават',
            'phone' => '+798799999999',
            'parent_id' => '',
            'brithday' => '11.06.1988',
            'visible' => null,
            ]
        );

        $this->insert('{{%patient}}', [
            'id' => '',
            'surname' => 'Баранов',
            'name' => 'Баранов',
            'patronymic' => 'Даниилович',
            'fullname' => 'Баранов Казимир Даниилович',
            'address_city' => 'г. Салават',
            'address_street' => 'ул. Бекетова',
            'address_home' => '5',
            'address_room' => '12',
            'document' => 'Паспорт',
            'passport_serial' => '8880',
            'passport_number' => '282828',
            'passport_issued' => 'УФМС г.Уфа',
            'phone' => '+74878888888',
            'parent_id' => '',
            'brithday' => '12.05.1969',
            'visible' => null,
            ]
        );

        $this->insert('{{%patient}}', [
            'id' => '',
            'surname' => 'Мишин',
            'name' => 'Артем',
            'patronymic' => 'Вячеславович',
            'fullname' => 'Мишин Артем Вячеславович',
            'address_city' => 'г. Уфа',
            'address_street' => 'ул. Уфимская',
            'address_home' => '225',
            'address_room' => '98',
            'document' => 'Паспорт',
            'passport_serial' => '8280',
            'passport_number' => '232828',
            'passport_issued' => 'УФМС г.Уфа',
            'phone' => '+79878883488',
            'parent_id' => '',
            'brithday' => '05.05.1989',
            'visible' => null,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230506_172324_generate_patient_value cannot be reverted.\n";

        return false;
    }
}
