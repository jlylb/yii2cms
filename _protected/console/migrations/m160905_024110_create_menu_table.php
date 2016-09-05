<?php

use yii\db\Migration;

/**
 * Handles the creation for table `menu`.
 */
class m160905_024110_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer(11),
            'lft' => $this->integer(11)->notNull(),
            'rgt' => $this->integer(11)->notNull(),
            'depth' => $this->integer(11)->notNull(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
