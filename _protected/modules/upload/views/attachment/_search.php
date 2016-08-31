<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model upload\models\AttachmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attachment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'entity_id') ?>

    <?= $form->field($model, 'entity_model') ?>

    <?= $form->field($model, 'path') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
