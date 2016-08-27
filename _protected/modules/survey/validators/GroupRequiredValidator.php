<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/11
 * Time: 20:27
 */
namespace survey\validators;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\validators\Validator;
use yii\validators\ValidationAsset;
use yii\web\JsExpression;

class GroupRequiredValidator extends Validator{

    public $targetClass;

    public $targetAttribute;

    public $max=3;

    public $maxMessage;
    
    public $sameMessage;

    public function init()
    {
        parent::init();
        if ($this->maxMessage === null) {
            $this->maxMessage =   '{attribute}至少填写{max}个选项.';
        }
        if ($this->message === null) {
            $this->message =   '{attribute}不能为空.';
        }
        if ($this->sameMessage === null) {
            $this->sameMessage =   '{attribute}不能相同.';
        }
    }

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        if ($this->targetClass === null) {
            throw new InvalidConfigException('GroupRequiredValidator::targetClass must be set.');
        }
        if ($this->targetAttribute === null) {
            throw new InvalidConfigException('GroupRequiredValidator::targetAttribute must be set.');
        }
        $subModel=new $this->targetClass();
        $validateAttribute=(array)$this->targetAttribute;
        $valid=true;
        $success=0;
        $values=[];
        $isSame=false;
        foreach($value as $item){
            $curItem=[];
            foreach($item as $kk=>$attr){
                if(!in_array($kk,$validateAttribute)){
                    unset($item[$kk]);
                }
                if($attr){
                    $curItem[]=$attr;
                }
            }
            foreach ($values as  $val) {
                if(!array_diff((array)$val,$curItem)){
                    $values[]=$curItem;
                }else{
                    $isSame=true;
                    break;
                }
            }
            $subModel->load($item,"");
            $valid=$subModel->validate()&&$valid;
            if($valid){
                $success++;
            }
        }
        if($success==0){
            $this->addError($model, $attribute, $this->message);
        }
        if($isSame){
            $this->addError($model, $attribute, $this->sameMessage);
        }
        if($success<$this->max){
            $this->addError($model, $attribute, $this->maxMessage,['max'=>$this->max]);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        ValidationAsset::register($view);
        $id=Html::getInputId($model, $attribute);
              $js=<<<EOT
              $("input[name*='{$attribute}']").on('blur',function(){
                jQuery('#form-options').yiiActiveForm('validateAttribute','{$id}');          
              });              
EOT;
      
      $view->registerJs($js);
        $options = [
            'message'=>$this->message,
            'maxMessage'=>$this->maxMessage,
            'sameMessage'=>$this->sameMessage,
        ];
        $i18n=Yii::$app->getI18n();
        $options['message'] = $i18n->format($options['message'], [
            'attribute' => $model->getAttributeLabel($attribute),
        ], Yii::$app->language);
        $options['maxMessage'] = $i18n->format($options['maxMessage'], [
            'attribute' => $model->getAttributeLabel($attribute),
            'max'=>$this->max
        ], Yii::$app->language);
        $options['sameMessage'] = $i18n->format($options['sameMessage'], [
            'attribute' => $model->getAttributeLabel($attribute),
        ], Yii::$app->language);

        return <<<EOT
        yii.validation.validateItemAttribute=function (attribute, messages) {
        var target = $("#" + attribute.id);
        var items = $("input[name*='{$attribute}']");
        function aa(){
             var i = 0,values=[],isSame=false;
             items.each(function () {
                var curVal=this.value;
                 if ( curVal ) {
                    i++;
                    if($.inArray(curVal,values)===-1){
                        values.push(this.value);
                    }else{
                        isSame=true;
                        return;
                    }                                         
                 }
             });
             if (i == 0) {
                messages.push('{$options["message"]}');
             }
            if(isSame){
                messages.push('{$options["sameMessage"]}');
            }
             if (i < 3) {
                messages.push('{$options["maxMessage"]}');
             }
            target.trigger('blur').trigger('change');
            return false;    
         }
        aa();
        }
yii.validation.validateItemAttribute(attribute,messages);
EOT;


    }

} 