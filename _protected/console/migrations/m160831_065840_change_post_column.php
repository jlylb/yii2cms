<?php

use yii\db\Migration;

class m160831_065840_change_post_column extends Migration
{
    public function up()
    {
        $this->execute("alter table {{%post%}} change first_img thumb_path VARCHAR(255)");
        $this->execute("alter table {{%post%}} change attach thumb_base_url VARCHAR(255)");
    }

    public function down()
    {
        echo "m160831_065840_change_post_column cannot be reverted.\n";

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
