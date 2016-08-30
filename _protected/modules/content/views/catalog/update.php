<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model content\models\Catalog */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Catalog',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="catalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
