<?php

namespace survey\helpers;

/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/11
 * Time: 16:14
 */

class Html extends \yii\helpers\Html{

    public static function activeInput1($type, $model, $attribute, $options = [])
    {
        $lines=$sublines=$subs=[];
        if(isset($options['subItems'])){
            $subs=$options['subItems'];
            unset($options['subItems']);
        }
        if(isset($options['num'])){
            $num=$options['num'];
            unset($options['num']);
        }
        if(isset($options['relationName'])){
            $relationName=$options['relationName'];
            unset($options['relationName']);
        }else{
            return ;
        }
        $relation=$model->getRelation($relationName);
        $class=$relation->modelClass;
        $models=$relation->all();
        if(is_string($subs)){
            $subs=[$subs];
        }
        $subModel=new $class();
        $len=max($num,count($models));
        for($i=0;$i<$len;$i++){
            $prefix=$i;
            if(!$model->isNewRecord&&$models){
                if(isset($models[$i])){
                    $subModel=$models[$i];
                    $prefix=$subModel->getPrimaryKey();
                }
            }

            foreach($subs as $k=>$v){
                $name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
                if (substr($name, -2) !== '[]') {
                    $name .= '['.$prefix.']';
                }
                $name.='['.$v.']';
                $value = isset($options['value']) ? $options['value'] : static::getAttributeValue($subModel, $v);
                $id = static::getInputId($model, $attribute);
                $options['id'] = $id."-".$prefix.'-'.$k;
                $sublines[]=static::tag('p', static::input($type, $name, $value, $options));
            }

            $lines[]=static::tag('fieldset',static::tag('legend',$model->getAttributeLabel($attribute).' '.$i). implode("\n", $sublines),['class'=>'form-group group']);
            $sublines=[];
        }
        $hidden = static::hiddenInput("","",['id'=>static::getInputId($model, $attribute)]);
        return $hidden.implode("\n", $lines);
    }

    public static function activeMuitiTextInput($model, $attribute, $options = []){
        self::normalizeMaxLength($model, $attribute, $options);
        return static::activeInput1('text', $model, $attribute, $options);
    }

    private static function normalizeMaxLength($model, $attribute, &$options)
    {
        if (isset($options['maxlength']) && $options['maxlength'] === true) {
            unset($options['maxlength']);
            $attrName = static::getAttributeName($attribute);
            foreach ($model->getActiveValidators($attrName) as $validator) {
                if ($validator instanceof StringValidator && $validator->max !== null) {
                    $options['maxlength'] = $validator->max;
                    break;
                }
            }
        }
    }
}
