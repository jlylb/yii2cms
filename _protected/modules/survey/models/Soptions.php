<?php

namespace backend\modules\survey\models;

use Yii;
use backend\modules\survey\validators\GroupRequiredValidator;
use backend\modules\survey\models\SoptionsItem;
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
    public $linkToSid;
    public $options;
    public $itemAttribute;
    public $itemAttribute1;
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
            [[ 'sshow','op_contents'], 'string'],
           [['itemAttribute'], GroupRequiredValidator::className(),'targetClass'=>SoptionsItem::className(),'targetAttribute'=>'title'],
            [['op_title'], 'string', 'max' => 30]
        ];
    }
        public function behaviors() {
            return [
                'items'=>[
                    'class' => 'backend\modules\survey\behaviors\ItemBehavior',
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
            'op_contents' => Yii::t('app', '问卷选项'),
            'sshow' => Yii::t('app', '显示方式'),
            'linkToSid'=>Yii::t('app', '关联问卷'),
            'itemAttribute'=>Yii::t('app', '填写问卷选项'),
        ];
    }
    public function validContent() {
        $value=$this->op_contents;
       // var_dump($value);die;
        if(is_array($value)){
            $arr=  array_filter($value);
        }else{
           $arr=  unserialize($value); 
        }
       if(count($arr)<3){
           $this->addError('options', '问卷选项至少3个');
           return;
       }

    }
    public function validateItemAttribute() {
        $values=$this->itemAttribute; 
        $item=new SoptionsItem();
        $valid = true;
        $success=0;
        foreach ($values as  $v) {
            $item->load($v,'');
            $valid = $item->validate() && $valid;
            if($valid){
               $success++; 
            }
        }
        if($success<3){
            $this->addError('itemAttribute1', '选项标题不能为空且至少填3个选项');
        }
    }
        public function validLinkToSid() {
        $value=  $this->sid;
        //Yii::trace($value);
       if(empty($value)||!is_numeric($value)){
           $this->addError('linkToSid', '问卷选项关联的问卷不存在！！ ');
            return;
       }

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
