<?php

namespace common\widgets\KEditor;

use Yii;
use yii\web\AssetBundle;

class KEditorAsset  extends AssetBundle
{
    public $sourcePath = '@common/widget/KEditor';
//    public $basePath = '@webroot';
//    public $baseUrl = '@themes';
    
    public $css = [
         'js/kindeditor.css',
    ];
    public $js = [
       'js/kindeditor.js',
    ];
    public $jsOptions = [
        'position'=>\yii\web\View::POS_END
    ];
    public $depends = [

    ];
    
}
