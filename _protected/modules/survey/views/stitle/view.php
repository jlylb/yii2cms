<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Stitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stitle-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'num',
            'is_auth'=>['attribute' =>'is_auth'],
            'is_status'=>['attribute' =>'is_status'],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ])
    ?>

</div>
