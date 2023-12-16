<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%good}}`.
 */
class m220822_194952_create_good_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%good}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(254)->notNull(),
            'slug' => $this->string(254)->notNull(),
            'price' => $this->decimal(10, 2),
            'old_price' => $this->decimal(10, 2),
            'category_id' => $this->integer(),
            'description' => $this->text(),
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
        $this->dropTable('{{%good}}');
    }
}
