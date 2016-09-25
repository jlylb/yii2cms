<?php
namespace common\widgets\holder;

use Yii;
use yii\web\AssetBundle;
use yii\web\View;

class HolderAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/holder/assets';
//    public $basePath = '@webroot';
//    public $baseUrl = '@themes';
    
    public $css = [
    ];
    public $js = [
        'js/holder.min.js',
    ];
    public $jsOptions = [
        'position'=>\yii\web\View::POS_HEAD
    ];
    public $depends = [

    ];
}


