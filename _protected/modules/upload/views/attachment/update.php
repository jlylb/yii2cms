<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model upload\models\Attachment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Attachment',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attachments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="attachment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
