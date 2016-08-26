<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/11
 * Time: 20:27
 */
namespace backend\modules\survey\validators;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\validators\Validator;

class GroupLengthValidator extends Validator{

    public $targetClass;

    public $targetAttribute;

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        $targetClass = $this->targetClass === null ? get_class($model) : $this->targetClass;
        $targetAttribute = $this->targetAttribute === null ? $attribute : $this->targetAttribute;
    }

} 