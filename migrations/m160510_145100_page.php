<?php

use yii\db\Migration;
use yii\db\Schema;

class m160510_145100_page extends Migration
{
    public function up()
    {
        $this->createTable('pages',[
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING.' NOT NULL',
            'url' => Schema::TYPE_STRING,
            'desc' => Schema::TYPE_TEXT,
            'seo_title' => Schema::TYPE_STRING,
            'seo_desc' => Schema::TYPE_TEXT,
            'seo_key' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('pages');
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
