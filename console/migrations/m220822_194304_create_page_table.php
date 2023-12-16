<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m220822_194304_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(254)->notNull(),
            'slug' => $this->string(254)->notNull(),
            'text_short' => $this->string(1000),
            'text' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'is_public' => $this->integer(1)->defaultValue(0),
            'is_delete' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}
