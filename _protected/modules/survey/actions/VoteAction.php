<?php
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/15
 * Time: 16:30
 */
namespace survey\actions;

use yii\base\Action;
use yii;
use survey\models\SoptionsItem;
use yii\web\Response;
use survey\models\StitleSearch;

class VoteAction extends  Action{

    use \survey\widgets\SurveyTrait;

    public function run()
    {
        $post=Yii::$app->request->post('options',[]);
        $sid=Yii::$app->request->post('survey_id',0);
        Yii::$app->response->format=Response::FORMAT_JSON;
        //var_dump($post);
        
        if(!$post){
            return ['message'=>'投票失败','status'=>0];
        }
        $smodel= new StitleSearch;
        $re=$smodel->searchOptions($sid);
        if(!$this->validateVote($re,$post)){
            return ['message'=>'请参加全部投票后再提交','status'=>0];
        }
        $cookies=Yii::$app->request->cookies;
        if ($cookies->has('is_voted')){
            return ['message'=>'已经投过票了','status'=>0];
        }
        $ids=array_reduce($post, 'array_merge',[]);
        
        $model=new SoptionsItem;
        
        $model->updateAllCounters(['num'=>1], ['in','id',$ids]);
        
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'is_voted',
            'value' => true,
        ]));

        return ['message'=>$this->_formatView($smodel->searchOptions($sid)),'status'=>1];
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