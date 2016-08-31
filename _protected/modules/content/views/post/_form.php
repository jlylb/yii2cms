<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use content\models\Catalog;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model content\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
<?=$form->errorSummary($model)?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'catalog_link')->dropDownList(array_column(Catalog::find()->asArray()->all(),'catalog_name' ,'id'), ['prompt' => '请选择栏目']) ?>

<!--    --><?//= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'seo_desc')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'copy_from')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'copy_url')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'view_num')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'favorite_num')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'focus_num')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'comment_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allow_comment')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ]) ?>

    <?= $form->field($model, 'tagValues')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'attachments')
        ->widget('trntv\filekit\widget\Upload',[
            'maxFileSize' => 10 * 1024 * 1024,
            'maxNumberOfFiles' => 3,
            'multiple'=>'true',
            'url' => ['post/upload'],
            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),  
        ]);
    echo $form->field($model, 'thumbnail')
        ->widget('trntv\filekit\widget\Upload',[
            'url' => ['post/upload'],
            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),  
        ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
