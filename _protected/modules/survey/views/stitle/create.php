<?php

use yii\helpers\Html;


$this->title = 'Create Stitle';
$this->params['breadcrumbs'][] = ['label' => 'Stitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stitle-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
