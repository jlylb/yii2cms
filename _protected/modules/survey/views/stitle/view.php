<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var backend\modules\survey\models\Stitle $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Stitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stitle-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>true,
            'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
            'panel'=>[
            'heading'=>$this->title,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
        'attributes' => [
            'title',
            'num',
            'is_auth'=>['attribute' =>'is_auth','type'=>DetailView::INPUT_SWITCH,'widgetOptions'=>['type'=>1]],
            'is_status'=>['attribute' =>'is_status','type'=>DetailView::INPUT_SWITCH,'widgetOptions'=>['type'=>1]],
        ],
        'deleteOptions'=>[
        'url'=>['delete', 'id' => $model->id],
        'data'=>[
        'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
        'method'=>'post',
        ],
        ],
        'enableEditMode'=>true,
    ]) ?>
<?php
use kartik\switchinput\SwitchInput;
echo SwitchInput::widget([
    'name' => 'status_1',
    'type' => SwitchInput::CHECKBOX,
    'items'=>[]
]);

?>
</div>
