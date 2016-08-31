<?php

use yii\db\Migration;

class m160831_022645_create_table_attachment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%attachment}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'entity_id' => $this->integer(11)->notNull(),
            'entity_model' => $this->string(255)->notNull(),
            'path' => $this->string(255)->notNull(),
            'type' => $this->string(255),
            'size' => $this->integer(11),
            'name' => $this->string(255),
            'order' => $this->integer(11)->defaultValue('0'),
            'created_at' => $this->integer(11),
        ], $tableOptions);
        
    }
    
    public function safeDown()
    {
        echo "m160831_022645_create_table_attachment cannot be reverted.\n";
        return false;
    }
}
