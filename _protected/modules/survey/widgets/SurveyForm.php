<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/15
 * Time: 15:19
 */
namespace backend\modules\survey\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\base\InvalidConfigException;
use backend\modules\survey\models\StitleSearch;
use yii\widgets\ActiveForm; 
use yii\helpers\Url;

class SurveyForm extends Widget{

    public $surveyId;
    public $formId;
    //protected $_form;
    public $url;
    
    public function init()
    {
        if($this->formId===NULL){
            $this->formId = $this->getId();
        }
        if($this->surveyId===NULL){
            return;
        }
        parent::init();
        echo Html::beginTag('div');
        ActiveForm::begin(['id'=>$this->formId,'action'=>  $this->url]);
    }

    public function run()
    {
        $model= new StitleSearch;
        $re=$model->searchOptions($this->surveyId);
        $this->registerJs();
//        return $this->render('survey-form',[
//            'content'=>$this->_formatQuestion($re),
//            'formId'=>$this->formId,
//        ]);
        echo $this->_formatQuestion($re);
        echo Html::tag('div', Html::submitButton('Create' , ['class' =>  'btn btn-success' ,'id'=>'btn-ok']), ['class'=>"form-group"]);
        ActiveForm::end();
        echo Html::endTag('div');
    }
    /**
     * 格式化问卷
     * @param array $soptions
     * @return string
     */
    private function _formatQuestion($soptions) {
        $soptions=reset($soptions);
        $html='';
        $options=$soptions['soptions'];
        $i=1;
        if(!empty($options)){
            foreach ($options as $k=>$v) {
                $items=$v['items'];
                if(!$items){
                    continue;
                }
                $title=  Html::tag('h2', ($i++).'.'.$v['op_title']);
                $input=$v['sshow']=='c'?'checkboxList':'radioList';
                $name='options['.$v['id'].'][]';
                $items=ArrayHelper::map($items,'id','title');
                $question=Html::$input($name,null,$items,['itemOptions'=>['labelOptions'=>['class'=>'help-block']]]);
                $class='field-'.$k;
                $error=Html::tag('div','',['class'=>'help-error']);
                $html.= Html::tag('div',$title.$question.$error,['class'=>'form-group '.$class]);
            }

        }
        return $html;
    }
    protected function registerJs() {
        $formId = $this->formId;
        $view=  $this->getView();
$js=<<<EOT
    jQuery('form#{$formId}').on('beforeSubmit', function (e) {
      var \$form = $(this);
      jQuery.ajax({
          url: \$form.attr('action'),
          type: 'post',
          data: \$form.serialize(),
          success: function (data) {
              // do something

        if(data.status==1){
            \$form.closest('div').empty().html(data.message);
        }else{
            alert(data.message);
        }
          }
      });
  }).on('submit', function (e) {
      e.preventDefault();
  }); 
EOT;
$view->registerJs($js);
    }
} 