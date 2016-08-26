<?php

use yii\db\Migration;

class m160826_073617_create_table_soptions extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%soptions}}', [
            'id' => $this->integer(8)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'sid' => $this->integer(8)->notNull()->comment('问卷ID'),
            'op_title' => $this->string(30)->notNull()->comment('问卷选项标题'),
            'op_contents' => $this->binary()->notNull()->comment('问卷选项'),
            'sshow' => $this->string()->notNull()->defaultValue('r')->comment('显示方式'),
        ], $tableOptions);
        
    }
    
    public function safeDown()
    {
        echo "m160826_073617_create_table_soptions cannot be reverted.\n";
        return false;
    }
}
