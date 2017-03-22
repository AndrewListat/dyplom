<?php

use yii\db\Migration;
use yii\db\Schema;

class m170306_173739_factory extends Migration
{
    public function up()
    {
        $this->createTable('factory',[
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING.' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER,
            'address' => Schema::TYPE_STRING.' NOT NULL',
            'coordinate_x' => Schema::TYPE_STRING,
            'coordinate_y' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('factory');
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
