<?php

use yii\helpers\Html;


$this->title = 'Update Stitle: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Stitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stitle-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
