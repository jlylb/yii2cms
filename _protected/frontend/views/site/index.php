<?php
use yii\helpers\Html;
use yii\widgets\ListView;  
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

?>

<div class="site-index">

    <div class="body-content">

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

