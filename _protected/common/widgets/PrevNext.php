<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\widgets;

use Yii;
use yii\bootstrap\Widget;
use yii\web\Request;
use yii\helpers\Html;

class PrevNext extends Widget{
    
    public $searchField='id';
    
    public $showField='title';
    
    public $tag='ul';
    
    public $tagClass='pager pager-justify';
    
    public $itemTag='li';
    
    public $prevClass='previous';
    
    public $prevIcon='icon-arrow-left';
    
    public $prevNoSet='没有上一篇';
    
    public $nextClass='next';
    
    public $nextIcon='icon-arrow-right';
    
    public $nextNoSet='没有下一篇';
    
    public $disabledClass='disabled';
    
    //public $itemTemplate='<li class="previous"><a href="#"><i class="icon-arrow-left"></i> 论烧火煮饭</a></li>';

    public $model;
       
    public function run()
    {
       $this->_renderButtons();
    }
    
    public function createUrl($data,$absolute = false)
    {
        $request = Yii::$app->getRequest();
        $params = $request instanceof Request ? $request->getQueryParams() : [];
        $params[0] = Yii::$app->controller->getRoute();
        $urlManager = Yii::$app->getUrlManager();
        $params=  array_merge($params,$data);
        if ($absolute) {
            return $urlManager->createAbsoluteUrl($params);
        } else {
            return $urlManager->createUrl($params);
        }
    }
    
    protected function _renderButtons() {
        $types=['prev','next'];
        $buttons='';
        foreach ($types as  $v) {           
            $buttons.=$this->_renderButton($v);
        }
       echo Html::tag($this->tag, $buttons, ['class'=>  $this->tagClass]);

    }
    
    protected function _renderButton($type) {
        if($type=='prev'){
            $orderType=SORT_DESC;
            $oprator='<';
        }else{
            $orderType=SORT_ASC;
            $oprator='>';
        }
        $class=get_class($this->model);
        $query=$class::find();
        $query->where([$oprator,$this->searchField,$this->model->{$this->searchField}]);
        $info=$query->select([$this->showField,$this->searchField])->orderBy([$this->searchField=>$orderType])->limit(1)->asArray()->one();
        $data=[];
        $url='#';
        $title='';
        if($info){
            $data=[$this->searchField=>$info[$this->searchField]];
            $url=  $this->createUrl($data);
            $title=$info[$this->showField];
        }
        
        return $this->renderItem($title, $type, $url);
    }
    
    public function renderItem($title,$type,$url) {
        if($type=='prev'){
            $class=  $this->prevClass;
            $iconClass=$this->prevIcon;
            $text=Html::tag('i','',['class'=>$iconClass]).' '.($title?:$this->prevNoSet);
        }else{
            $class=  $this->nextClass;
            $iconClass=$this->nextIcon;
            $text=($title?:$this->nextNoSet).' '.Html::tag('i','',['class'=>$iconClass]);
        }
        
        $str=Html::beginTag($this->itemTag,['class'=>$class]);
        $str.=Html::a($text, $url);
        $str.=Html::endTag($this->itemTag);
        return $str;
    }
    
}
