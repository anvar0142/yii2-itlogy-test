<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lessons}}`.
 */
class m231122_101506_create_lessons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lessons}}', [
            'id' => $this->primaryKey(),
            'video_link' => $this->string()->notNull(),
            'status' => $this->boolean()->defaultValue(false),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lessons}}');
    }
}
