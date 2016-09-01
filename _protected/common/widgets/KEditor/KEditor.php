<?php
namespace common\widgets\KEditor;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\Inflector;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;

class KEditor extends \yii\widgets\InputWidget {

    public $textareaOptions = array();
    /*
     * 编辑器属性集。
     */
    public $properties = array();
    
    private $_defaultItems = array('source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link', 'unlink');
    
    private $_defaultActions=[
        'afterCreate'=>'function() {
                        this.sync();
					}',
        'afterBlur'=>'function() {
                this.sync();
                jQuery("#$this->id").trigger("blur");
            }',
        ];
    /*
     * TEXTAREA的id，可为空
     */

   // public $form;
 

    public static function getUploadPath() {
        $path=Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.'data';
        if (isset(Yii::$app->params->uploadPath)) {
            $path=$path.DIRECTORY_SEPARATOR.Yii::$app->params->uploadPath;
        }
        return $path;
    }

    public static function getUploadUrl() {
        $path=Yii::getAlias('@web').'/data';
        if (isset(Yii::$app->params->uploadPath)) {
            $path=$path.Yii::$app->params->uploadPath; 
        }
        return $path;
    }

    public function init() {
        parent::init();
        if ($this->hasModel()) {
            $this->name = empty($this->options['name']) ? Html::getInputName($this->model, $this->attribute) :
                $this->options['name'];
            $this->value = Html::getAttributeValue($this->model, $this->attribute);
        }
    }

    public function run() {

        $textAreaOptions = $this->gettextareaOptions();
        $this->id = $textAreaOptions['id'] = $this->options['id'];
        $this->registerAssets();
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute,$textAreaOptions);
        }
        return Html::textarea($this->name,'',$textAreaOptions);
       
    }

    public function gettextareaOptions() {
        //允许获取的属性
        $allowParams = array('rows', 'cols', 'style','class');
        //准备返回的属性数组
        $params = array();
        foreach ($allowParams as $key) {
            if (isset($this->textareaOptions[$key]))
                $params[$key] = $this->textareaOptions[$key];
        }
        $params['name'] = $params['id'] = $this->name;
        return $params;
    }

    public function getKeProperties() {
        $properties_key = array(
            'width',
            'height',
            'minWidth',
            'minHeight',
            'items',
            'noDisableItems',
            'filterMode',
            'htmlTags',
            'wellFormatMode',
            'resizeType',
            'themeType',
            'langType',
            'designMode',
            'fullscreenMode',
            'basePath',
            'themesPath',
            'pluginsPath',
            'langPath',
            'minChangeSize',
            'urlType',
            'newlineTag',
            'pasteType',
            'dialogAlignType',
            'shadowMode',
            'useContextmenu',
            'syncType',
            'indentChar',
            'cssPath',
            'cssData',
            'bodyClass',
            'colorTable',
            'afterCreate',
            'afterChange',
            'afterTab',
            'afterFocus',
            'afterBlur',
            'afterUpload',
            'uploadJson',
            'fileManagerJson',
            'allowPreviewEmoticons',
            'allowImageUpload',
            'allowFlashUpload',
            'allowMediaUpload',
            'allowFileUpload',
            'allowFileManager',
            'fontSizeTable',
            'imageTabIndex',
            'formatUploadUrl',
            'fullscreenShortcut',
            'extraFileUploadParams',
            'loadStyleMode'
        );

        //准备返回的属性数组
        $params = array();
        foreach ($properties_key as $key) {
            if (isset($this->properties[$key]))
                $params[$key] = $this->properties[$key];
        }
        if(!isset($params['items'])||empty($params['items'])){
            $params['items']=  $this->_defaultItems;
        }
        $params=ArrayHelper::merge($this->_formatActions(), $params);
        return $params;
    }
    //
    private function _formatActions() {
        return [
            'afterCreate'=>new JsExpression('function() {
                        this.sync();
					}'),
            'afterBlur'=>new JsExpression('function() {
                this.sync();
                jQuery("#'.$this->id.'").trigger("blur");
            }'),
        ];
    }
    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        KEditorAsset::register($view);
        $theme=$this->properties['themeType']?:'default';
        $view->registerCssFile(__DIR__.'/js/themes/'.$theme.'/'.$theme.'.css');
        $properties_string = Json::encode($this->getKeProperties());
        $id=  Inflector::id2camel($this->id);
        $js = <<<EOF
KindEditor.ready(function(K) {
	var editor_$id = K.create('#$this->id', 
$properties_string
	);
                      
});
EOF;

    $view->registerJs($js,\yii\web\View::POS_READY);
    }
}
