<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\survey\models\Soptions */

$this->title = 'Create Soptions';
$this->params['breadcrumbs'][] = ['label' => 'Soptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soptions-create">
<?php if($id){?>
    <h1>问卷:<?= Html::encode($stitle) ?></h1>
<?php }?>
    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
        'stitle' => $stitle,
    ]) ?>

</div>
