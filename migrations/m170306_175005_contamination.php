<?php

use yii\db\Migration;
use yii\db\Schema;

class m170306_175005_contamination extends Migration
{
    public function up()
    {
        $this->createTable('contamination',[
            'id' => Schema::TYPE_PK,
            'h' => Schema::TYPE_FLOAT,
            'd' => Schema::TYPE_FLOAT,
            'T' => Schema::TYPE_FLOAT,
            'v' => Schema::TYPE_FLOAT,
            'factory_id' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('contamination');
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
