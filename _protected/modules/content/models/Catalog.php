<?php

namespace content\models;

use Yii;

/**
 * This is the model class for table "{{%catalog}}".
 *
 * @property string $id
 * @property string $pid
 * @property string $catalog_english
 * @property string $catalog_name
 * @property string $sort_num
 * @property string $status
 * @property string $create_time
 *
 * @property Post[] $posts
 */
class Catalog extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            'timeAttr'=>[
               'class' => 'yii\behaviors\TimestampBehavior',
//              'createdAtAttribute' => 'create_time',
//              'updatedAtAttribute' => 'update_time',
              'value' => new \yii\db\Expression('NOW()'),
               'attributes'=>[
                    self::EVENT_BEFORE_INSERT=>'create_time',
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sort_num'], 'integer'],
            [['catalog_english', 'catalog_name'], 'required'],
            [['status'], 'string'],
            [['create_time'], 'safe'],
            [['catalog_english', 'catalog_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自增编号'),
            'pid' => Yii::t('app', '父id'),
            'catalog_english' => Yii::t('app', '栏目英文名称'),
            'catalog_name' => Yii::t('app', '栏目名称'),
            'sort_num' => Yii::t('app', '排序字段'),
            'status' => Yii::t('app', '栏目状态'),
            'create_time' => Yii::t('app', '栏目创建时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['catalog_link' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CatalogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CatalogQuery(get_called_class());
    }
    
    public  function getParentTagName()
    {
        return $this->hasOne(self::className(), ['id'=>'pid'])->from(['p' => self::tableName()]);
    }
}
