<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\survey\models\StitleSearch $searchModel
 */

$this->title = 'Stitles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stitle-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Stitle', ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\CheckboxColumn'],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'title',
                'pageSummary' => 'Page Total',
                'vAlign'=>'middle',
                'headerOptions'=>['class'=>'kv-sticky-column'],
                'contentOptions'=>['class'=>'kv-sticky-column'],
                'editableOptions'=>['header'=>'title', 'size'=>'md']
            ],
            [
               'attribute'=>'num', 
               'width'=>'80px',
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
               'attribute'=>'is_auth', 
               'vAlign'=>'middle',
                'trueLabel'=>'审核',
                'falseLabel'=>'未审核',
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
               'attribute'=>'is_status', 
               'vAlign'=>'middle',
                'trueLabel'=>'启用',
                'falseLabel'=>'未启用',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                 'width'=>'150px',
               // 'dropdown'=>true,
                'template'=>'{view} {view_question}{view_result} {update} {delete} {addop}',
                'buttons' => [
                'update' => function ($url, $model) {
                                    return Html::a('<span class="fa fa-pencil"></span>', Yii::$app->urlManager->createUrl(['survey/stitle/view','id' => $model->id,'edit'=>'t']), [
                                                    'title' => Yii::t('yii', 'Edit'),
                                                  ]);},
                'addop' => function ($url, $model) {
                                  return Html::a('<span class="fa fa-plus"></span>', Yii::$app->urlManager->createUrl(['survey/soptions/create','sid' => $model->id]), [
                                                    'title' => 'add options', 
                                                  ]);
                                    
                },
                'view_question' => function ($url, $model) {
                                  return Html::a('<span class="fa fa-eye"></span>', 'javascript:void(0);', [
                                                    'title' => 'preview question', 'data-id'=>$model->id, 'data-op'=>'question', 'class'=>'preview'
                                                  ]);
                                    
                },
               'view_result' => function ($url, $model) {
                                  return Html::a('<span class="fa fa-eye"></span>', 'javascript:void(0);', [
                                                    'title' => 'view result', 'data-id'=>$model->id,'data-op'=>'result', 'class'=>'preview'
                                                  ]);
                                    
                },
                ],
            ],
        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
       // 'floatHeader'=>true,




        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="fa fa-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'primary',
            'before'=>Html::a('<i class="fa fa-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]); Pjax::end(); ?>

</div>
<?php
use yii\bootstrap\Modal;
Modal::begin([
    'header' => '<label id="title">Hello world</label>',
    'toggleButton' => false,
    'options'=>['id'=>'preview_modal'],
]);

echo 'Say hello...';

Modal::end();
  ?>
<script>
<?php $this->beginBlock('JS_END') ?>
    $('.preview').on('click',function(){
       // var id=$(this).data('id');
       var param=$(this).data();
        $.ajax({
            url:'<?= Url::toRoute(['questions']) ?>',
            type:'post',
            dataType:'json',
            data:param
            
        }).done(function(data){
            var obj=$('#preview_modal');
            obj.find('#title').html(data.title);
            obj.find('.modal-body').html(data.soptions);
            obj.modal('show');
        });
        
    });
<?php $this->endBlock(); ?>
</script>
<?php
use kartik\rating\StarRating;
// With model & without ActiveForm
echo StarRating::widget([
    'name' => 'rating_1',
    'pluginOptions' => ['disabled'=>false, 'showClear'=>false]
]);

?>

<?php
$this->registerJs($this->blocks['JS_END'], yii\web\View::POS_END);