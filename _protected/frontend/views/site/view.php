<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $model->title.'-'.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->title];
?>
<section class="">
  <article>
    <div >

      <article class="article">
        <header>
          <h1 class="text-center"><?= Html::encode($model->title) ?></h1>
          <dl class="dl-inline">
            <dt>发布时间：</dt>
            <dd><?= $model->create_time ?></dd>
            <dt>作者：</dt>
            <dd><?= Html::encode($model->author) ?></dd>
            <dt></dt>
            <dd class="pull-right">
                <span class="label label-success">NEW</span>
                <span class="label label-info">原创</span>
                <span class="label label-danger">
                    <i class="icon-eye-open"></i> <?= $model->view_num ?>
                </span>
            </dd>
          </dl>
        </header>
        <section class="article-content">
            <?= Html::decode($model->content) ?>
        </section>
        <footer>
          <p class="pull-right text-muted">
            发布时间：<?= $model->create_time ?> &nbsp;点击数：<?= $model->view_num ?>
          </p>
          <p class="text-important">本文版权所有归<a href="###">@<?=$model->author?></a></p>
          <ul class="pager pager-justify">
            <li class="previous"><a href="#"><i class="icon-arrow-left"></i> 论烧火煮饭</a></li>
            <li><a href="#"><i class="icon-list-ul"></i> 目录</a></li>
            <li class="next disabled"><a href="#">没有下一篇 <i class="icon-arrow-right"></i></a></li>
          </ul>
        </footer>
      </article>
    </div>
  </article>
</section>
<?php echo \yii2mod\comments\widgets\Comment::widget([
    'model' => $model,
    'relatedTo' => 'User ' . \Yii::$app->user->identity->username . ' commented on the page ' . \yii\helpers\Url::current(), // for example
    'maxLevel' => 3, 
    'showDeletedComments' => false 
]); ?>