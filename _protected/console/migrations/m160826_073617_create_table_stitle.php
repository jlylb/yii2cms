<?php

use yii\db\Migration;

class m160826_073617_create_table_stitle extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%stitle}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'title' => $this->string(30)->notNull()->comment('问答标题'),
            'num' => $this->smallInteger(6)->notNull()->comment('问答数量'),
            'is_auth' => $this->smallInteger(1)->notNull()->defaultValue('0')->comment('是否审核'),
            'is_status' => $this->smallInteger(1)->notNull()->defaultValue('1')->comment('是否启问卷用'),
            'created_at' => $this->integer(11)->comment('问卷创建时间'),
            'updated_at' => $this->integer(11)->comment('问卷更新时间'),
            'uid' => $this->smallInteger(11)->comment('问卷创建者'),
        ], $tableOptions);
        
    }
    
    public function safeDown()
    {
        echo "m160826_073617_create_table_stitle cannot be reverted.\n";
        return false;
    }
}
