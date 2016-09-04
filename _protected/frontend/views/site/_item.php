<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="item">
  <div class="item-heading">
    <div class="pull-right"></div>
    <h4><span class="label label-success">NEW</span>&nbsp; <a href="<?=Url::to(['site/view','id'=>$model->id])?>"><?= Html::encode($model->title) ?></a></h4>
  </div>
  <div class="item-content">
      <?php 
         echo Html::encode($model->intro);
      ?>
  </div>
  <div class="item-footer">
    <a class="text-muted" href="#"><i class="icon-comments"></i> <?= $model->comment_num?:0 ?></a>&nbsp;
    <span class="text-muted"><?= $model->create_time ?></span>
  </div>
</div>