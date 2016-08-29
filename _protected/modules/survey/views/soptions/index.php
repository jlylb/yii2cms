<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use conquer\select2\Select2Widget;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = 'Soptions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="soptions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Soptions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'attribute'=>'sid',
                'value'=>function($model,$key,$index){
                    return $model->stitle->title;
                },
                'filter'=> Select2::widget([
                    'name'=>'SoptionsSearch[sid]',
                    'initValueText'=> $searchModel->stitle?$searchModel->stitle->title:'',
                    'value'=> Yii::$app->request->get('SoptionsSearch')?Yii::$app->request->get('SoptionsSearch')
                    ['sid']:'',
                    'language' => 'zh-cn',
                    'options' => ['placeholder' => '请选择一个问卷'],
                    'pluginOptions' => [
                        'width'=>'250px',
                        'allowClear' => true,
                        'ajax'=>[
                            'url'=>Url::to(['soptions/titles']),
                            'processResults'=>new JsExpression(' function (data) {
                            return {
                              results: data
                            };
                        }'),
                            'data'=> new JsExpression('function (params) {
                            var query = {
                              q: params.term,
                              page: params.page
                            }
                            return query;
                            }'),
                        ],
                    ],
                ])
            ],
            'op_title',
            [
                'attribute'=>'sshow',
                'filter'=>$searchModel->getShowWay(),
                'value'=>function($model,$key,$index){
                    //var_dump($key);
                    return $model->getShowWay()[$model->sshow];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                                return Html::a('<span class="fa fa-pencil"></span>', Yii::$app->urlManager->createUrl(['survey/soptions/view','id' => $model->id,'edit'=>'t']), [
                                                    'title' => Yii::t('yii', 'Edit'),
                                                  ]);
                                    
                    },
                    'view' => function ($url, $model) {
                                  return Html::a('<span class="fa fa-eye"></span>', Yii::$app->urlManager->createUrl(['survey/soptions/view','id' => $model->id]), [
                                                    'title' => 'view', 
                                                  ]);                                    
                    },
                ],
            ],
        ],
    ]); ?>

</div>
