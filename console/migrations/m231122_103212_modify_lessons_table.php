<?php

use yii\db\Migration;

/**
 * Class m231122_103212_modify_lessons_table
 */
class m231122_103212_modify_lessons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%lessons}}', 'description', $this->text()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropColumn('{{%lessons}}', 'description');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231122_103212_modify_lessons_table cannot be reverted.\n";

        return false;
    }
    */
}
