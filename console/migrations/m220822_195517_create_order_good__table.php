<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_good_}}`.
 */
class m220822_195517_create_order_good__table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_good_}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'good_id' => $this->integer(),
            'price' => $this->decimal(10, 2),
            'quantity' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_good_}}');
    }
}
