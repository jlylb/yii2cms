<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use survey\widgets\SurveyForm;
use survey\widgets\SurveyResult;
use yii\helpers\Url;

$arr = $model->getShowWay();
$this->title = $model->op_title;
$this->params['breadcrumbs'][] = ['label' => 'Soptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soptions-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute'=>'sid',
                    'value'=>$model->stitle->title
                ],
                'op_title',
                [
                    'label' =>'问卷选项',
                    'format'=>'raw',
                    'value'=>$model->sshow=='c'?
                    Html::checkboxList('title', null, \yii\helpers\ArrayHelper::getColumn($model->items,'title')?:[],['separator'=>'<br>']):
                    Html::radioList('title', null, \yii\helpers\ArrayHelper::getColumn($model->items,'title')?:[],['separator'=>'<br>']),
                    ],
                'sshow'=>['attribute'=>'sshow','value'=>$arr[$model->sshow]],
            ],
    ]) ?>

</div>
<?= SurveyForm::widget([
    'surveyId'=>11,
    'formId'=>'form-options',
    'url'=>Url::to(['soptions/vote']),
])?>
<?= SurveyResult::widget([
    'surveyId'=>6,
])?>