<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel content\models\CatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Catalogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Catalog'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'pid',
                'label'=>'上级目录',
                'value'=>function($model){
                    return $model->parentTagName?$model->parentTagName->catalog_name:'根目录';
                }
            ],
            'catalog_english',
            'catalog_name',
            'sort_num',
            // 'status',
            // 'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
