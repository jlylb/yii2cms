<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
//use kartik\detail\DetailView;
use backend\modules\survey\models\Stitle;
use common\widget\DetailView;
use backend\modules\survey\widgets\SurveyForm;
use backend\modules\survey\widgets\SurveyResult;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\survey\models\Soptions */
//$title=Stitle::findOne(['id'=>$model->sid]);
//Yii::trace($title->title);
$arr = Yii::$app->params['showArr'];
$this->title = $model->op_title;
$this->params['breadcrumbs'][] = ['label' => 'Soptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soptions-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'condensed'=>false,
            'hover'=>true,
            'mode'=> DetailView::MODE_VIEW,
            'panel'=>[
            'heading'=>$this->title,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
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
        'deleteOptions'=>[
        'url'=>['delete', 'id' => $model->id],
        'data'=>[
        'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
        'method'=>'post',
        ],
        ],
        'enableEditMode'=>false,
    ]) ?>

</div>
<?= SurveyForm::widget([
    'surveyId'=>6,
    'formId'=>'form-options',
    'url'=>Url::to(['soptions/vote']),
])?>
<?= SurveyResult::widget([
    'surveyId'=>6,
])?>