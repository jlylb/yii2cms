<?php

namespace content\models;

use Yii;

/**
 * This is the base-model class for table "tie_post".
 *
 * @property string $id
 * @property string $uid
 * @property string $title
 * @property string $intro
 * @property string $content
 * @property string $catalog_link
 * @property string $author
 * @property string $tags
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_desc
 * @property string $copy_from
 * @property string $copy_url
 * @property string $view_num
 * @property string $favorite_num
 * @property string $focus_num
 * @property string $comment_num
 * @property string $allow_comment
 * @property string $status
 * @property string $fisrt_img
 * @property string $attach
 * @property string $create_time
 * @property string $update_time
 *
 * @property \common\models\Catalog $catalogLink
 */
class Post extends \common\base\BaseModel
{

    /**
    * ENUM field values
    */
    const ALLOW_COMMENT_Y = 'Y';
    const ALLOW_COMMENT_N = 'N';
    const STATUS_Y = 'Y';
    const STATUS_N = 'N';
    
    var $enum_labels = false;
    
    public function behaviors() {
        return [
            'autoAttr'=>[
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                        self::EVENT_BEFORE_INSERT => 'uid',
                    ]
            ],
            'timeAttr'=>[
               'class' => 'yii\behaviors\TimestampBehavior',
              'createdAtAttribute' => 'create_time',
              'updatedAtAttribute' => 'update_time',
              'value' => new \yii\db\Expression('NOW()'),
            ],
            'fillAttr'=>[
                'class' => 'common\behaviors\AutoAttributeBehavior',
                'attributes' => [
                        self::EVENT_BEFORE_INSERT => ['author'=>'11111'],
                    ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'catalog_link'], 'required'],
            [['uid', 'catalog_link', 'view_num', 'favorite_num', 'focus_num', 'comment_num'], 'integer'],
            [['intro', 'content', 'allow_comment', 'status'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['title', 'copy_from', 'fisrt_img'], 'string', 'max' => 100],
            [['author'], 'string', 'max' => 50],
            [['tags', 'seo_title', 'seo_keywords', 'seo_desc', 'copy_url', 'attach'], 'string', 'max' => 255],
            ['allow_comment', 'in', 'range' => [
                    self::ALLOW_COMMENT_Y,
                    self::ALLOW_COMMENT_N,
                ]
            ],
            ['status', 'in', 'range' => [
                    self::STATUS_Y,
                    self::STATUS_N,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增编号',
            'uid' => '用户编号',
            'title' => '标题',
            'intro' => '文章摘要',
            'content' => '内容',
            'catalog_link' => '所属栏目',
            'author' => '文章作者',
            'tags' => '文章标签',
            'seo_title' => 'SEO标题',
            'seo_keywords' => 'SEO关键字',
            'seo_desc' => 'SEO描述',
            'copy_from' => '来源',
            'copy_url' => '来源url',
            'view_num' => '浏览数量',
            'favorite_num' => '收藏数量',
            'focus_num' => '关注次数',
            'comment_num' => '评论数',
            'allow_comment' => '是否允许评论',
            'status' => '文章状态',
            'fisrt_img' => '文章封面图',
            'attach' => '文章附件',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogLink()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_link']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'uid']);
    }

    
    /**
     * get column allow_comment enum value label 
     * @param string $value
     * @return string
     */
    public static function getAllowCommentValueLabel($value){
        $labels = self::optsAllowComment();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }
   
    /**
     * column allow_comment ENUM value labels
     * @return array
     */    
    public static function optsAllowComment()
    {
        return [
            self::ALLOW_COMMENT_Y => '开启评论',
            self::ALLOW_COMMENT_N => '关闭评论',
        
        ];
    }
    
    /**
     * get column status enum value label 
     * @param string $value
     * @return string
     */
    public static function getStatusValueLabel($value){
        $labels = self::optsStatus();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }
   
    /**
     * column status ENUM value labels
     * @return array
     */    
    public static function optsStatus()
    {
        return [
            self::STATUS_Y => '发布',
            self::STATUS_N => '未发布',
        
        ];
    }
    
}
