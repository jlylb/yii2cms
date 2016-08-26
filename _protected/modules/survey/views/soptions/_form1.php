<?php

use yii\helpers\Html;
use common\helpers\Help;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\Json;
use common\models\base\Post;
use yii\helpers\Url;

$controller = $this->context;
$actionName=$controller->action->id;
/* @var $this yii\web\View */
/* @var $model backend\modules\survey\models\Soptions */
/* @var $form yii\widgets\ActiveForm */

$items=$model->items;
//var_dump($model->getRelation('items')->modelClass);
//print_r($items);
$fname=$model->formName();
?>

<div class="soptions-form">
    <div class="row">
        <div class="col-lg-6">  
    <?php $form = ActiveForm::begin(['id'=>'form-options']); ?>


    <?= $form->field($model, 'op_title')->textInput(['maxlength' => 30]) ?>
    <?php
        use kartik\select2\Select2;
        echo $form->field($model, 'sid')->widget(Select2::classname(), [
            'initValueText' => $model->stitle?$model->stitle->title:'',
            'language' => 'zh',
            'options' => ['placeholder' => '请选择问卷'],
            'pluginOptions' => [
                'allowClear' => true,
                'ajax'=>[
                    'url'=>Url::to(['soptions/titles']),
                    'processResults'=>new JsExpression('function(data){
                        return {results:data};
                  }'),
                ],
            ],
        ]);
    ?>

<!--    --><?//= $form->field($model, 'itemAttribute1')->hiddenInput(['id' => 'itemAttribute1']) ?>

            <?= $form->field($model, 'itemAttribute',['class'=>'\common\component\MultiField'])->textInput(['subItems'=>["title"],'relationName'=>'items']) ?>
        
 <div class="row">            
    <div class="col-lg-10 txt-block">

        <div class="form-group items-copy field-soptionsitem-title hidden">
            <label for="soptionsitem-title" class="control-label">选项标题</label>
            <input type="text" value=""  class="form-control" id="soptionsitem-title">
        </div>

<!--        --><?php
//        if($items){
//            foreach($items as $item){
//        ?>
<!--         --><?//= $form->field($item, 'title',['options'=>['class'=>'form-group items-copy']])->textInput(['name'=>$fname.'[itemAttribute]['.$item->id.'][title]']) ?>
<!--         --><?php
//            }
//        }else{
//            for($i=0;$i<3;$i++){
//        ?>
<!--            <div class="form-group items-copy field-soptionsitem-title">-->
<!--                <label for="soptionsitem-title" class="control-label">选项标题</label>-->
<!--                <input type="text" value="" name="--><?//=$fname?><!--[itemAttribute][][title]" class="form-control" >-->
<!--            </div>-->
<!--        --><?php
//            }
//        }
//         ?>

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
</div>
</div>
<?=$form->errorSummary($model)?>
<script>
<?php $this->beginBlock('JS_END') ?>
$('#add_op').on('click',function(){
    var obj=$('.txt-block'),_clone=$('.items-copy').eq(0).clone();
    var target=_clone.removeClass('hidden').find('input').attr({"name":"<?=$fname?>[itemAttribute][][title]"}).end();
    target.appendTo(obj);
});

$('.items-copy').not('.hidden').find('input')
    .on('blur',function(){
    var i=0;

    var target=$('#itemAttribute1');
    if(this.value && i==0){
        target.val(this.value).trigger('blur');
    }
    $(this).closest('.items-copy')
        .not('.hidden').find('input').each(function(){
            if(this.value){
                i++;
            }
    });
    if(!this.value && i==0){
        target.val('').trigger('blur');
    }
    if(i>=3){
        target.trigger('blur');
    }
});
function validateItem(){
    var target=$('#itemAttribute1');
    if(!$.trim(target.val())){
        return ;
    }

    var items=$('.items-copy').not('.hidden').find('input');
    items.each(function(){
        if(this.value){
            target.val(this.value).trigger('blur');
            return;
        }
    });
}
validateItem();

<?php $this->endBlock(); ?>
</script>
<?php
$this->registerJs($this->blocks['JS_END'], yii\web\View::POS_END);