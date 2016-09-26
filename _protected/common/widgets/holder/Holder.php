<?php
namespace common\widgets\holder;

use Yii;
use yii\web\View;
use \yii\helpers\Html;
use yii\web\JsExpression;

/**
 *   Placeholder options are set through URL properties, e.g. holder.js/300x200?x=y&a=b. Multiple options are separated by the & character.
 *
 *    theme: The theme to use for the placeholder. Example: holder.js/300x200?theme=sky
 *    random: Use random theme. Example: holder.js/300x200?random=yes
 *    bg: Background color. Example: holder.js/300x200?bg=2a2025
 *    fg: Foreground (text) color. Example: holder.js/300x200?fg=ffffff
 *    text: Custom text. Example: holder.js/300x200?text=Hello
 *    size: Custom text size. Defaults to pt units. Example: holder.js/300x200?size=50
 *    font: Custom text font. Example: holder.js/300x200?font=Helvetica
 *    align: Custom text alignment (left, right). Example: holder.js/300x200?align=left
 *    outline: Draw outline and diagonals for placeholder. Example: holder.js/300x200?outline=yes
 *    lineWrap: Maximum line length to image width ratio. Example: holder.js/300x200?lineWrap=0.5
 *
 * */
class Holder extends \yii\base\Widget
{    
    public $id;
    
    public $class='';
    
    public $options=[];
    
    public $size=[100,100];
    
    
    
    public function init()
    {
        parent::init();
        if(empty($this->id)){
            $this->id=  $this->getId();
        }
        if(isset($this->options['text'])){
            $this->options['text']= Html::encode($this->options['text']);
        }
    }
    
    public  function registerAssets()
    {
        $view=$this->getView();
        HolderAsset::register($view);
    }
    
    public function run()
    {
        $this->registerAssets();
        return $this->renderItems();
    }
    
    public function generateSrc()
    {
//        $class=New \ReflectionClass($this);
//        $prop=$class->getProperties(\ReflectionProperty::IS_PUBLIC);
////        \yii::trace($prop);
////        \yii::trace(__CLASS__);
//        $params=[];
//        foreach ($prop as $v) {
//            if($v->class==__CLASS__){
//                $params[$v->getName()]=$v->getValue($this);
//            }
//        }
//        unset($params['id'],$params['size'],$params['class']);
        $paramStr=http_build_query(array_filter($this->options));
        $src='holder.js/'.implode('x', $this->size).($paramStr?'?'.$paramStr:'');
        return $src;        
    }
    
    protected function renderItems()
    {        
        return Html::tag('img', '', ['id'=>$this->id,'data-src'=>  $this->generateSrc(),'class'=>$this->class]);
    }
}


