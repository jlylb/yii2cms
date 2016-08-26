<?php

use yii\db\Migration;

class m160826_073617_create_table_soptions_item extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%soptions_item}}', [
            'id' => $this->integer(10)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'title' => $this->string(250),
            'num' => $this->integer(11)->defaultValue('0'),
            'option_id' => $this->integer(11),
        ], $tableOptions);
        
    }
    
    public function safeDown()
    {
        echo "m160826_073617_create_table_soptions_item cannot be reverted.\n";
        return false;
    }
}
