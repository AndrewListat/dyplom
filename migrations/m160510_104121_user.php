<?php

use yii\db\Schema;
use yii\db\Migration;

class m160510_104121_user extends Migration
{
    public function up()
    {
        $this->createTable('users',[
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING,
            'lastname' => Schema::TYPE_STRING,
            'login' => Schema::TYPE_STRING.' NOT NULL',
            'email' => Schema::TYPE_STRING.' NOT NULL',
            'password_hash' => Schema::TYPE_STRING.' NOT NULL',
            'password' => Schema::TYPE_STRING.' NOT NULL',
            'status' => Schema::TYPE_SMALLINT.' NOT NULL',
            'role' => Schema::TYPE_STRING.' NOT NULL',
            'auth_key' => Schema::TYPE_STRING.'(32) NOT NULL',
            'secret_key' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
