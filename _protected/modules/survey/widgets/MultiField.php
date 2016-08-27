<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/11
 * Time: 15:40
 */

namespace survey\widgets;
use yii\widgets\ActiveField;
use survey\helpers\Html;

class MultiField extends ActiveField{

    public $template = "{label}\n{input}\n{hint}\n{error}";

    public $num=3;

    public function textInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $options['num']=$this->num;
        $this->parts['{input}'] = Html::activeMuitiTextInput($this->model, $this->attribute, $options);

        return $this;
    }

} 