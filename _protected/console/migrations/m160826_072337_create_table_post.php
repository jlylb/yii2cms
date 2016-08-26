<?php

use yii\db\Migration;

class m160826_072337_create_table_post extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%post}}', [
            'id' => $this->integer(11)->unsigned()->notNull()->comment('自增编号')->append('AUTO_INCREMENT PRIMARY KEY'),
            'uid' => $this->integer(11)->unsigned()->notNull()->comment('用户编号'),
            'title' => $this->string(100)->notNull()->comment('标题'),
            'intro' => $this->text()->comment('文章摘要'),
            'content' => $this->text()->notNull()->comment('内容'),
            'catalog_link' => $this->integer(10)->unsigned()->notNull()->comment('所属栏目'),
            'author' => $this->string(50)->comment('文章作者'),
            'tags' => $this->string(255)->comment('文章标签'),
            'seo_title' => $this->string(255)->comment('SEO标题'),
            'seo_keywords' => $this->string(255)->comment('SEO关键字'),
            'seo_desc' => $this->string(255)->comment('SEO描述'),
            'copy_from' => $this->string(100)->comment('来源'),
            'copy_url' => $this->string(255)->comment('来源url'),
            'view_num' => $this->integer(11)->unsigned()->defaultValue('0')->comment('浏览数量'),
            'favorite_num' => $this->integer(11)->unsigned()->defaultValue('0')->comment('收藏数量'),
            'focus_num' => $this->integer(11)->unsigned()->defaultValue('0')->comment('关注次数'),
            'comment_num' => $this->integer(11)->unsigned()->defaultValue('0')->comment('评论数'),
            'allow_comment' => $this->string()->defaultValue('Y')->comment('是否允许评论'),
            'status' => $this->string()->defaultValue('Y')->comment('文章状态'),
            'first_img' => $this->string(100)->comment('文章封面图'),
            'attach' => $this->string(255)->comment('文章附件'),
            'create_time' => $this->timestamp()->comment('创建时间'),
            'update_time' => $this->timestamp()->comment('更新时间'),
        ], $tableOptions);
        
        $this->addForeignKey('fk_post_catalog_link', '{{%post}}', 'catalog_link', '{{%catalog}}', 'id');
    }
    
    public function safeDown()
    {
        echo "m160826_072337_create_table_post cannot be reverted.\n";
        return false;
    }
}
