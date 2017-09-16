<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m170915_183918_create_customer_table extends Migration
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
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'firstName' => $this->string()->notNull(),
            'lastName' => $this->string()->notNull()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%customer}}');
    }
}
