<?php

use yii\db\Migration;

class m160826_072529_create_table_tags extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%tags}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->comment('自增编号')->append('AUTO_INCREMENT PRIMARY KEY'),
            'name' => $this->string(50)->notNull()->comment('标签名'),
            'frequency' => $this->integer(11)->defaultValue('0')->comment('文章统计数量'),
        ], $tableOptions);
        
    }
    
    public function safeDown()
    {
        echo "m160826_072529_create_table_tags cannot be reverted.\n";
        return false;
    }
}
