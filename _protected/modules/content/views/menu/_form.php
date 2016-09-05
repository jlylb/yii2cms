<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
<!---->
<!--    --><?//= $form->field($model, 'tree')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'lft')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'rgt')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'depth')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->errorSummary($model) ?>

    <?php ActiveForm::end(); ?>

</div>
