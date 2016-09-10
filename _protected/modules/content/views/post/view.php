<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model content\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attachments=$model->attachments;
$thumbnail=$model->thumbnail;

function formatAttachments($arr){
    if(!$arr){
        return '没有附件';
    }
    $str='';
    foreach ($arr as $v){
        $str.=sprintf('<p>%s</p>',  Html::a(basename($v['path']),$v['base_url'].$v['path'],['target'=>'_blank']));
    }
    return $str;
}
?>
<div class="post-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.username',
            'title',
            'intro:ntext',
            'content:html',
            'catalogLink.catalog_name',
            'author',
            'tagValues',
            'seo_title',
            'seo_keywords',
            'seo_desc',
            'copy_from',
            'copy_url:url',
            'view_num',
            'favorite_num',
            'focus_num',
            'comment_num',
            'allow_comment',
            [     
              'label' => '文章附件',
              'value' => formatAttachments($attachments),
                'format'=>'html'
            ],
            [
              'label' => '文章封面',
              'value' =>$thumbnail? Html::img($thumbnail['base_url'].'/'.$thumbnail['path']):"没有封面",
               'format'=>'html'
            ],
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
