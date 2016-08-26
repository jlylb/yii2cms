<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var backend\modules\survey\models\Stitle $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="stitle-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 问答标题...', 'maxlength'=>30]], 

'num'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 问答数量...']], 

'is_auth'=>['type'=> Form::INPUT_DROPDOWN_LIST, 'options'=>['placeholder'=>'Enter 是否审核...'],'items'=>['1'=>'审核','0'=>'不审核']], 

'is_status'=>['type'=> Form::INPUT_DROPDOWN_LIST, 'options'=>['placeholder'=>'Enter 是否启问卷用...'],'items'=>['1'=>'启用','0'=>'禁用']], 


//'time'=>['type'=> Form::INPUT_WIDGET,'widgetClass'=>'kartik\datetime\DateTimePicker', 'options'=>[
//    'name' => 'datetime_10',
//    'options' => ['placeholder' => 'Select operating time ...'],
//    'convertFormat' => true,
//    'pluginOptions' => [
//        'format' => 'yyyy-MM-dd hh:i:ss',
//        'language'=>'zh-CN',
//        'todayHighlight' => true
//    ]
//]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
