<?php

use yii\db\Migration;

class m160910_193218_change_column_entity_on_comment extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%comment}}', 'entity', 'varchar(100) not null');
    }

    public function down()
    {
        echo "m160910_193218_change_column_entity_on_comment cannot be reverted.\n";

        return false;
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
