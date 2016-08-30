<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model content\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'intro') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'catalog_link') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'seo_title') ?>

    <?php // echo $form->field($model, 'seo_keywords') ?>

    <?php // echo $form->field($model, 'seo_desc') ?>

    <?php // echo $form->field($model, 'copy_from') ?>

    <?php // echo $form->field($model, 'copy_url') ?>

    <?php // echo $form->field($model, 'view_num') ?>

    <?php // echo $form->field($model, 'favorite_num') ?>

    <?php // echo $form->field($model, 'focus_num') ?>

    <?php // echo $form->field($model, 'comment_num') ?>

    <?php // echo $form->field($model, 'allow_comment') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'first_img') ?>

    <?php // echo $form->field($model, 'attach') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
