<?php

use yii\db\Migration;

/**
 * Class m230206_214232_add_access_token_user
 */
class m230206_214232_add_access_token_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'access_token', $this->string(254));
    }

    public function down()
    {
        $this->dropColumn('user', 'access_token');
    }
}
