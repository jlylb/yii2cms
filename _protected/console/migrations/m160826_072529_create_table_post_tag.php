<?php

use yii\db\Migration;

class m160826_072529_create_table_post_tag extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%post_tag}}', [
            'tag_id' => $this->integer(11)->unsigned()->notNull()->comment('标签id')->append('PRIMARY KEY'),
            'post_id' => $this->integer(11)->unsigned()->notNull()->comment('文章id')->append('PRIMARY KEY'),
        ], $tableOptions);
        
    }
    
    public function safeDown()
    {
        echo "m160826_072529_create_table_post_tag cannot be reverted.\n";
        return false;
    }
}
