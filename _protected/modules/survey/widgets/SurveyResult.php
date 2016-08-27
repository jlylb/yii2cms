<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/15
 * Time: 15:19
 */
namespace survey\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;
use yii\base\InvalidConfigException;
use survey\models\StitleSearch;

class SurveyResult extends Widget{

    use \survey\widgets\SurveyTrait;
    
    public $surveyId;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if($this->surveyId===NULL){
            return;
        }
        $model= new StitleSearch;
        $re=$model->searchOptions($this->surveyId);
        echo Html::beginTag('div');
        echo $this->_formatView($re);
        echo Html::endTag('div');

    }


} 