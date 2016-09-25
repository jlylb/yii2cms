<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Carousel;
use common\widgets\holder\Holder;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

?>

<div class="site-index">

    <div class="body-content" style=" margin-top: 80px;">
<?php
//  echo Carousel::widget([
//      'items' => [
//      Holder::widget(['size'=>['100p',300],"options"=>['theme'=>'sky']]),
//      Holder::widget(['size'=>['100p',300],"options"=>['theme'=>'lava']]),
//      Holder::widget(['size'=>['100p',300],"options"=>['theme'=>'industrial']]),
//      Holder::widget(['size'=>['100p',300],"options"=>['theme'=>'vine']]),
//      Holder::widget(['size'=>['100p',300],"options"=>['theme'=>'social']]),
//
////          ['content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-02.jpg"/>'],
////          [
////              'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
////              'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
////          ],
//      ]
//  ]);

?>
    <?php echo \widget\widgets\DbCarousel::widget([
        'key'=>'home image22',
        'options' => [
            'class' => 'slide',
        ],
    ]) ?>

        <div class="row">
           <div class="list">
        <section class="items items-hover">
            <?php  
            echo ListView::widget([  
                'dataProvider' => $dataProvider, 
                'pager'=>[
                    'options'=>['class'=>'pager'],
                ],
                'sorter'=>[
                    'options'=>['class'=>'pager pull-right'],
                ],
                'summaryOptions'=>['class'=>'pager pull-left'],
                'layout' => "<header class='clearfix'>{summary}{sorter}</header>\n{items}\n{pager}",
                'itemView' => '_item',//子视图  
            ]);  
            ?>
        </section>
      </div>
        </div>

    </div>
</div>

