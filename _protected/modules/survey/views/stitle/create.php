<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\survey\models\Stitle $model
 */

$this->title = 'Create Stitle';
$this->params['breadcrumbs'][] = ['label' => 'Stitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stitle-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
