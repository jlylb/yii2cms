<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/16
 * Time: 15:22
 */
namespace backend\modules\survey\widgets;
use yii\helpers\Html;

Trait SurveyTrait{

    /**
     * 格式化查看结果
     * @param array $soptions
     * @return string
     */
    protected  function _formatView($soptions) {
        $soptions=reset($soptions);
        $html='';
        $letters=array('A'=>'primary','B'=>'success','C'=>'info','D'=>'warning','E'=>'danger',);
        $colors=  array_values($letters);
        $keys=  array_keys($letters);
        $options=$soptions['soptions'];
        $i=1;
        if(!empty($options)){
            foreach ($options as $k=>$v) {
                $title=  Html::tag('h2', ($i++).'.'.$v['op_title']);
                $items=$v['items'];
                $questions='';
                if($items){
                    $total=array_sum(array_column($items, 'num'));
                    foreach ($items as $kk => $vv) {
                        $color=$colors[$kk%5];
                        $labelClass='label-'.$color;
                        $progressClass='progress-bar-'.$color;
                        $mark=Html::tag('span',$keys[$kk],['class'=>'label '.$labelClass]);
                        $label=Html::tag('label',$vv['title'],['class'=>'control-label']);
                        $percent=  sprintf('%.2f',$vv['num']*100/$total);
                        $question=\yii\bootstrap\Progress::widget([
                            'percent' => $percent,
                            'label' => $percent.'%',
                            'barOptions' => ['class' => $progressClass]
                        ]);
                        $questions .= Html::tag('div',$mark.'  '.$label.$question,['class'=>'form-group']);
                    }
                }

                $html.= Html::tag('div',$title.$questions,['class'=>'form-group']);
            }

        }
        return $html;
    }

    protected function _renderItems($items) {
        if(!$items){
            return ;
        }
        $letters=array('A'=>'primary','B'=>'success','C'=>'info','D'=>'warning','E'=>'danger',);
        $colors=  array_values($letters);
        $keys=  array_keys($letters);
        $total=array_sum(array_column($items, 'num'));
        foreach ($items as $kk => $vv) {
            $color=$colors[$kk%5];
            $labelClass='label-'.$color;
            $progressClass='progress-bar-'.$color;
            $mark=Html::tag('span',$keys[$kk],['class'=>'label '.$labelClass]);
            $label=Html::tag('label',$vv['title'],['class'=>'control-label']);
            $percent=  sprintf('%.2f',$vv['num']*100/$total);
            $question=\yii\bootstrap\Progress::widget([
                'percent' => $percent,
                'label' => $percent.'%',
                'barOptions' => ['class' => $progressClass]
            ]);
            $questions = Html::tag('div',$mark.'  '.$label.$question,['class'=>'form-group']);
        }
        return $questions;
    }
}