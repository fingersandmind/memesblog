<?php

use yii\db\Migration;

/**
 * Class m180522_080750_add_posts_images_to_posts_table
 */
class m180522_080750_add_posts_images_to_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts','posts_images','string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('posts','posts_images');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180522_080750_add_posts_images_to_posts_table cannot be reverted.\n";

        return false;
    }
    */
}
