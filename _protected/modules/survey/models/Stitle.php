<?php

namespace survey\models;

use Yii;

/**
 * This is the model class for table "{{%stitle}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $num
 * @property integer $is_auth
 * @property integer $is_status
 * @property string $time
 * @property integer $uid
 */
class Stitle extends \yii\db\ActiveRecord
{
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
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stitle}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'num'], 'required'],
            [['num', 'is_auth', 'is_status', 'uid'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['created_at','updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '问答标题'),
            'num' => Yii::t('app', '问答数量'),
            'is_auth' => Yii::t('app', '是否审核'),
            'is_status' => Yii::t('app', '是否启问卷用'),
            'created_at' => Yii::t('app', '问卷创建时间'),
            'updated_at' => Yii::t('app', '问卷更新时间'),
            'uid' => Yii::t('app', '问卷创建者'),
        ];
    }
    /**
     * 获取选项
     * @return type
     */
    public function getSoptions() {
         return $this->hasMany(Soptions::className(), ['sid' => 'id']);
    }
    
    public function getItems() {
        return $this->hasMany(SoptionsItem::className(), [
            'option_id'=>'id'
        ]);        
    }
    
}
