<?php

use yii\db\Migration;

/**
 * Class m170916_121341_alter_table_user_add_access_token_column
 */
class m170916_121341_alter_table_user_add_access_token_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'access_token', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'access_token');
    }
}
