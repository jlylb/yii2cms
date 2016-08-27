<?php

use yii\helpers\Html;


$this->title = 'Update Stitle: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Stitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stitle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
