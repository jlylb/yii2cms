<?php
namespace common\widgets\KEditor;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\Inflector;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class KEditor extends \yii\widgets\InputWidget {

    public $properties = [];

    private $_defaultItems = [
        'source', '|',
        'fontname', 'fontsize', '|',
        'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'removeformat', '|',
        'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist', '|',
        'image', 'link', 'unlink'
    ];
 


    public function init() {
        parent::init();
        if ($this->hasModel()) {
            $this->name = empty($this->options['name']) ? Html::getInputName($this->model, $this->attribute) :
                $this->options['name'];
            $this->value = Html::getAttributeValue($this->model, $this->attribute);
        }
    }

    public function run() {

        $this->id =  $this->options['id'];

        $this->registerAssets();

        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, $this->options);
        }
        return Html::textarea($this->name,'',$this->options);
       
    }


    public function setProperties() {

        $params=ArrayHelper::merge($this->_default(), $this->properties);

        if(isset($params['items'])&&is_string($params['items'])){
            $params['items']=  $this->_defaultItems;
        }

        $this->properties=$params;

    }

    private function _default() {
        return [
            'themeType' => 'default',
            'items' => 'default',
            'loadStyleMode'=>false,
            'uploadJson' => Url::toRoute('editor-upload'),
            'fileManagerJson' => Url::toRoute('editor-manage'),
            'newlineTag' => 'br',
            'allowFileManager' => true,
            'width'=>'100%',
            'height'=>'350px',
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
        $this->setProperties();
        $theme=$this->properties['themeType']?:'default';
        $url=$view->getAssetManager()->publish('@common/widgets/KEditor');
        $view->registerCssFile($url[1].'/js/themes/'.$theme.'/'.$theme.'.css',[
            'depends'=>'common\widgets\KEditor\KEditorAsset'
        ]);
        $properties_string = Json::encode($this->properties);
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
