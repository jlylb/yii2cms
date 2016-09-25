<?php
/** @var $this yii\web\View
 * @var $model common\models\WidgetCarouselItem
 * @var $carousel common\models\WidgetCarousel
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Widget Carousel Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Carousel Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $carousel->key, 'url' => ['update', 'id' => $carousel->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="widget-carousel-item-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
