<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/15
 * Time: 16:30
 */
namespace backend\modules\survey\actions;

use yii\base\Action;
use yii;
use backend\modules\survey\models\SoptionsItem;
use yii\web\Response;
use backend\modules\survey\models\StitleSearch;

class VoteAction extends  Action{

    use \backend\modules\survey\widgets\SurveyTrait;

    public function run()
    {
        $post=Yii::$app->request->post('options',[]);

        Yii::$app->response->format=Response::FORMAT_JSON;
        //var_dump($post);
        
        if(!$post){
            return ['message'=>'投票失败','status'=>0];
        }
        $smodel= new StitleSearch;
        $re=$smodel->searchOptions(6);
        if(!$this->validateVote($re,$post)){
            return ['message'=>'请参加全部投票后再提交','status'=>0];
        }
        $ids=array_reduce($post, 'array_merge',[]);
        
        $model=new SoptionsItem;
        
        $model->updateAllCounters(['num'=>1], ['in','id',$ids]);

        return ['message'=>$this->_formatView($re),'status'=>1];
    }

    protected function findModel($id)
    {
        if (($model = SoptionsItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //验证选项
    public function validateVote($data,$post) {
        $items=reset($data)['soptions'];
        if(!$items){
            return false;
        }
        
        $result =[];
        
        foreach ($items as  $value) {
            if(!$value['items']){
                continue;
            }
            $result[$value['id']]=  array_column($value['items'], 'id');
        }
        $error=[];
        foreach ($result as $k => $v) {
            if(!isset($post[$k])){
                $error[$k]=false;
            }else{
                if(!array_intersect((array)$post[$k], $v)){
                    $error[$k]=false;
                }
            }
        }
        if($error){
            return false;
        }
        return true;
    }
} 