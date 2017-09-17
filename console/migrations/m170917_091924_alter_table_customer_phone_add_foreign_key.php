<?php

use yii\db\Migration;

class m170917_091924_alter_table_customer_phone_add_foreign_key extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'phone_customer_to_customer',
            '{{%customer_phone}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
       $this->dropForeignKey('phone_customer_to_customer', '{{%customer_phone}}');
    }
}
