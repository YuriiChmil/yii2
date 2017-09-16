<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer_phone`.
 */
class m170915_183940_create_customer_phone_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%customer_phone}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'phone' => $this->string(12)->notNull()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%customer_phone}}');
    }
}
