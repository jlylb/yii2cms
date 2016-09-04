<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model content\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'content:ntext',
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
              'value' => '',
            ],
            [
              'label' => '文章封面',
              'value' => ''
            ],
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
