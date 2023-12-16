<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m220822_195502_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'number' => $this->string(254)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'user_name' => $this->string(254),
            'user_phone' => $this->string(20),
            'user_comment' => $this->string(1000),
            'status' => $this->integer(1)->defaultValue(0),
            'payment_status' => $this->integer(1)->defaultValue(0),
            'date' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
