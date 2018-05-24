<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180517_124031_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(60)->notNull(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->dateTime()
                ->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()
            ->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-posts-user_id',
            'posts','user_id'
        );

        $this->addForeignKey(
            'fk-posts-user',
            'posts','user_id',
            'user', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-posts-user','posts');
        $this->dropIndex('idx-posts-user_id', 'posts');
        $this->dropTable('posts');
    }
}
