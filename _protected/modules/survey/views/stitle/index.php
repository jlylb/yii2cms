<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;


$this->title = 'Stitle';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stitle-index">
    <?= Html::a('Create Stitle', ['create'], ['class' => 'btn btn-success']) ?>
    <?php

    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'attribute' => 'title',
            ],
            [
               'attribute'=>'num',
            ],
            [
               'attribute'=>'is_auth',
            ],
            [
               'attribute'=>'is_status',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
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
    ]);

    Pjax::end();
?>

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
$this->registerJs($this->blocks['JS_END'], yii\web\View::POS_END);