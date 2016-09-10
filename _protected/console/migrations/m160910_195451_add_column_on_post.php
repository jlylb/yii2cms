<?php

use yii\db\Migration;

class m160910_195451_add_column_on_post extends Migration
{
    public function up()
    {
        $this->addColumn('{{%post}}', 'survey_id', $this->integer()->defaultValue(0)->comment('关联的问卷')->after('status'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%post}}', 'survey_id');
    }
}
