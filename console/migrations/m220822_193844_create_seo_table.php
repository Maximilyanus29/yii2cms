<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seo}}`.
 */
class m220822_193844_create_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%seo}}', [
            'id' => $this->primaryKey(),
            'entity_name' => $this->string(255)->notNull(),
            'entity_id' => $this->integer()->defaultValue(0),
            'h1' => $this->string(500),
            'title' => $this->string(500),
            'keywords' => $this->string(500),
            'description' => $this->string(500),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%seo}}');
    }
}
