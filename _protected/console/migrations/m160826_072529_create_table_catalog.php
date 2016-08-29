<?php

use yii\db\Migration;

class m160826_072529_create_table_catalog extends Migration
{
//    public function safeUp()
//    {
//        $tableOptions = null;
//        if ($this->db->driverName === 'mysql') {
//            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
//        }
//        
//        $this->createTable('{{%catalog}}', [
//            'id' => $this->integer(11)->unsigned()->notNull()->comment('自增编号')->append('AUTO_INCREMENT PRIMARY KEY'),
//            'pid' => $this->integer(11)->unsigned()->defaultValue('0')->comment('父id'),
//            'catalog_english' => $this->string(50)->notNull()->comment('栏目英文名称'),
//            'catalog_name' => $this->string(50)->notNull()->comment('栏目名称'),
//            'sort_num' => $this->integer(11)->unsigned()->defaultValue('0')->comment('排序字段'),
//            'status' => $this->string()->defaultValue('Y')->comment('栏目状态'),
//            'create_time' => $this->timestamp()->comment('栏目创建时间'),
//        ], $tableOptions);
//        
//    }
//    
//    public function safeDown()
//    {
//        echo "m160826_072529_create_table_catalog cannot be reverted.\n";
//        return false;
//    }
}
