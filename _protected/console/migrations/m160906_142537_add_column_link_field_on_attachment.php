<?php

use yii\db\Migration;

class m160906_142537_add_column_link_field_on_attachment extends Migration
{
    public function up()
    {
        $this->addColumn('{{%attachment}}', 'link_field', $this->string(100)->after('entity_model'));
    }

    public function down()
    {
        $this->dropColumn('{{%attachment}}', 'link_field');
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
