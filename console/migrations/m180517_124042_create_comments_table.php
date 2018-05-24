<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m180517_124042_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'create_at' => $this->dateTime()
                ->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-comments-user_id', 
            'comments','user_id'
        );
        $this->addForeignKey(
            'fk-comments-users',
            'comments', 'user_id',
            'user', 'id'
        );

        $this->createIndex(
            'idx-comments-post_id',
            'comments', 'post_id'
        );
        $this->addForeignKey(
            'fk-comments-posts',
            'comments', 'post_id',
            'posts', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-comments-users', 'comments');
        $this->dropForeignKey('fk-comments-posts', 'comments');
        $this->dropIndex('idx-comments-user_id','comments');
        $this->dropIndex('idx-comments-post_id','comments');
        $this->dropTable('comments');
    }
}
