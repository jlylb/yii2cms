<?php

namespace survey\models;

use Yii;
use survey\validators\GroupRequiredValidator;
use survey\models\SoptionsItem;

/**
 * This is the model class for table "{{%soptions}}".
 *
 * @property integer $id
 * @property integer $sid
 * @property string $op_title
 * @property resource $op_contents
 * @property string $sshow
 */
class Soptions extends \yii\db\ActiveRecord
{

    public $itemAttribute;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%soptions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'op_title'], 'required'],
            [['sid'], 'integer'],
            [[ 'sshow'], 'string'],
            [['itemAttribute'], GroupRequiredValidator::className(),'targetClass'=>SoptionsItem::className(),'targetAttribute'=>'title'],
            [['op_title'], 'string', 'max' => 30]
        ];
    }
        public function behaviors() {
            return [
                'items'=>[
                    'class' => 'survey\behaviors\ItemBehavior',
                ],
            ];
                
        }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '问卷选项编号'),
            'sid' => Yii::t('app', '问卷名称'),
            'op_title' => Yii::t('app', '问卷选项标题'),
            'sshow' => Yii::t('app', '显示方式'),
            'itemAttribute'=>Yii::t('app', '填写问卷选项'),
        ];
    }

    public function getItems() {
        return $this->hasMany(SoptionsItem::className(), [
            'option_id'=>'id'
        ]);        
    }
    public function getStitle() {
        return $this->hasOne(Stitle::className(), [
            'id'=>'sid'
        ]);        
    }
    public function getShowWay() {
        return [
            'r'=>'单选',
            'c'=>'多选',
            'o'=>'其他',
        ];
    }
}
