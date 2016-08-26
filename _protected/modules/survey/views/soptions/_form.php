<?php

use yii\helpers\Html;
use common\helpers\Help;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\Json;
use yii\helpers\Url;
$controller = $this->context;
$actionName=$controller->action->id;
use common\component\MultiField;
$fname=$model->formName();
//var_dump($id);
?>

<div class="soptions-form">
    <div class="row">
        <div class="col-lg-6">  
    <?php $form = ActiveForm::begin(['id'=>'form-options']); ?>

    <?= $form->field($model, 'op_title')->textInput(['maxlength' => 30]) ?>
<?php 
use kartik\select2\Select2;
echo $form->field($model, 'sid')->widget(Select2::classname(), [
    //'data' => ['id'=>'3','text'=>'444'],
   // 'value'=>1,
    'initValueText'=>isset($id)?$stitle:($model->stitle?$model->stitle->title:''),
    'language' => 'zh-cn',
    'options' => ['placeholder' => '请选择一个问卷'],
    'pluginOptions' => [
        'allowClear' => true,
        //'tags'=> true, 
        'ajax'=>[
            'url'=>Url::to(['soptions/titles']),
//            'url'=>new JsExpression('function (params) {'
//                    . 'return "'.Url::to(['soptions/titles']).'?q="+(params.term||"")}'),
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
]);      
    
?>        
 <div class="row">            
    <div class="col-lg-10 txt-block">
        <?= $form->field($model, 'itemAttribute',['class'=>MultiField::className()])->textInput(['subItems' => 'title','relationName'=>'items']) ?>
    </div>
     <div class="col-lg-2" style=" padding-top: 28px">            
        <?=  Help::icon('plus', ['title'=>'添加选项','style'=>'cursor:pointer','class'=>'fa-2x','id'=>'add_op'],'fa fa-')?>
    </div>
</div>                              
    <?= $form->field($model, 'sshow')->dropDownList([ 'r' => '单选', 'c' => '多选', 'o' => '其他', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'btn-ok']) ?>
       
    </div>

    <?php ActiveForm::end(); ?>
    </div> 
      <?php 

      
     ?>
</div>
</div>
<?php echo $form->errorSummary($model); ?>  
<script>
<?php $this->beginBlock('JS_END') ?>
$('#add_op').on('click',function(){
    var obj=$('.txt-block'),_clone=obj.find('.group').eq(0).clone();
    var $inputs=obj.find('.group input');
    var indexs=[],len=$inputs.length,prefix;
    $inputs.each(function(){
        var name=this.id.split('-');
        indexs.push(name.slice(-2,-1)[0]);
        prefix=name.slice(0,-2);
    });
    var maxIndex=+Math.max.apply(null,indexs);
    var id=prefix.concat([maxIndex,0]).join('-');
    var name=$($inputs[0]).attr('name').replace(/\[\d+\]/,'[]');
    var target=_clone.find('input').attr({"id":id,"value":"","name":name}).end();
    target.find('legend').text(target.find('legend').text().replace(/\d+/,len)).end();
   obj.find('.group:last').after(target);
});

<?php $this->endBlock(); ?>
</script>
<?php
$js=<<<TO

TO;

$this->registerJs($this->blocks['JS_END'], yii\web\View::POS_END);
$this->registerJs($js, yii\web\View::POS_READY);