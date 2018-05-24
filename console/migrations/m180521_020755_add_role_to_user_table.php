<?php

use yii\db\Migration;

/**
 * Class m180521_020755_add_role_to_user_table
 */
class m180521_020755_add_role_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','role','integer NOT NULL DEFAULT "300"');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180521_020755_add_role_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
