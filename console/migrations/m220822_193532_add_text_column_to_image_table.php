<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%image}}`.
 */
class m220822_193532_add_text_column_to_image_table extends Migration
{
    public function up()
    {
        $this->addColumn('image', 'text', $this->string(254));
    }

    public function down()
    {
        $this->dropColumn('image', 'text');
    }
}
