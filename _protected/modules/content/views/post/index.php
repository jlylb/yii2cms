<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use content\models\Catalog;
use common\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel content\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                 'attribute'=>'uid',
                 'value'=>function($model){
                    return $model->user->username;
                 },
                 'filter'=>ArrayHelper::map(User::find()->select(['id','username'])->asArray()->all(), 'id', 'username'),
             ],
            'title',
           // 'intro:ntext',
           // 'content:ntext',
             [
                 'attribute'=>'catalog_link',
                 'value'=>function($model){
                    return $model->catalogLink->catalog_name;
                 },
                 'filter'=>ArrayHelper::map(Catalog::find()->select(['id','catalog_name'])->asArray()->all(), 'id', 'catalog_name'),
             ],
            // 'author',
            // 'tagValues',
            // 'seo_title',
            // 'seo_keywords',
            // 'seo_desc',
            // 'copy_from',
            // 'copy_url:url',
            // 'view_num',
            // 'favorite_num',
            // 'focus_num',
            // 'comment_num',
             'allow_comment',
             'status',
            // 'first_img',
            // 'attach',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
