<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/15
 * Time: 15:43
 */
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id'=>'form-options','action'=>Url::to(['soptions/vote'])]); ?>

<?=$content?>

<div class="form-group">
    <?= Html::submitButton('Create' , ['class' =>  'btn btn-success' ,'id'=>'btn-ok']) ?>
</div>
<?php ActiveForm::end(); ?>