<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\Menu;


var_dump($this->context->getRoute(),Yii::$app->controller->module->getUniqueId());
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
        'renderInnerContainer'=>false,
    ]);
    $menuItems = [
        ['label' => '首页', 'url' => ['/site/index']],
        ['label' => '内容', 'url' => ['/content']],
        ['label' => '评论', 'url' => ['/comment']],
        ['label' => '问卷', 'url' => ['/survey']],
        ['label' => '附件', 'url' => ['/upload']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'logout ('.Yii::$app->user->identity->username.')', 'url' => ['/site/logout']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="" style="margin-top: 80px;">
        <div class="col-lg-2"> 
            <?php 
                    $menuItems = [];

            //        if($this->context->module->id=='admin'){
            //            $menuItems=  $this->context->module->getMenus();
            //        }
                    if($this->context->module->id=='content'){
                        $menuItems=  [
                           ['label' => '文章列表', 'url' => ['/content/post/index']],
                           ['label' => '文章分类', 'url' => ['/content/catalog/index']],
                           ['label' => '文章标签', 'url' => ['/content/tags/index']],
                        ];
                    }
                    if($this->context->module->id=='survey'){
                        $menuItems=  [
                           ['label' => '问卷标题', 'url' => ['/survey/stitle/index']],
                           ['label' => '问卷选项', 'url' => ['/survey/soptions/index']],
                        ];
                    }
                    if($this->context->module->id=='comment'){
                        $menuItems=  [
                           ['label' => '评论列表', 'url' => ['/comment/manage/index']],
                        ];
                    }
                    if($this->context->module->id=='upload'){
                        $menuItems=  [
                           ['label' => '附件列表', 'url' => ['/upload/attachment/index']],
                        ];
                    }

                    echo Menu::widget([
                       'items' => $menuItems,
                       'options'=>['class'=>'list-group'],
                       'itemOptions'=>['class'=>'list-group-item'],
                    ]);
            ?>
        </div>
        <div class="col-lg-10">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>    
    </div>
</div>

<!--<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
