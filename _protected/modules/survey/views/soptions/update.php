<?php

use yii\helpers\Html;


$this->title = 'Update Soptions: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Soptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soptions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
