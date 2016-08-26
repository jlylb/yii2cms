<?php

namespace backend\modules\survey\controllers;

use Yii;
use backend\modules\survey\models\Stitle;
use backend\modules\survey\models\StitleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Response;

/**
 * StitleController implements the CRUD actions for Stitle model.
 */
class StitleController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * Lists all Stitle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StitleSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
//                $model= new StitleSearch;
//        $re=$model->searchOptions(6);
//        print_r($re);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Stitle model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
        } else {
        return $this->render('view', ['model' => $model]);
}
    }
    public function actionDetail()
    {
        $this->layout=false;
        $model = $this->findModel(Yii::$app->request->post('expandRowKey'));
        return $this->render('view', ['model' => $model]);

    }
    /**
     * Creates a new Stitle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stitle;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stitle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * 获取问卷
     * @param int $id 问卷编号
     * @return type
     */
    public function actionQuestions()
    {
        $post=Yii::$app->request->post();
        $id=$post['id'];
        $op=$post['op']; 
        $model= new StitleSearch;
        $re=$model->searchOptions($id);
        \Yii::$app->response->format =Response::FORMAT_JSON;
        $op || $op='question';
        $re=reset($re);
        if($op=='question'){
            $html=$this->_formatQuestion($re);
        }else{
          $html=$this->_formatView($re);  
        }
                
        $data['soptions']=$html;
        return $data;
        
    }
        public function actionDetail2()
    {
        $post=Yii::$app->request->post();
        $id=$post['expandRowKey'];
        $op=$post['op'];       
        $query = Stitle::find();
        $arr= $query ->joinWith('soptions')->where('tie_stitle.id='.$id)->asArray()->all();
        //print_r($arr);
        $data=$arr[0];
        $soptions=$data['soptions'];
        $op || $op='question';
        if($op=='question'){
            $html=$this->_formatQuestion($soptions);
        }else{
          $html=$this->_formatView($soptions);  
        }
        // echo $html;       
       return $this->renderPartial('detail', ['html' => $html]);

    }
    /**
     * 格式化查看结果
     * @param array $soptions
     * @return string
     */
    private function _formatView($soptions) {
        $html='';
        $letters=array('A'=>'default','B'=>'primary','C'=>'success','D'=>'info','E'=>'warning','F'=>'danger',);
        $colors=  array_values($letters);
        $keys=  array_keys($letters);
        $options=$soptions['soptions'];
        if(!empty($options)){
            foreach ($options as $k=>$v) {
                 $title=  Html::tag('h2', ($k+1).'.'.$v['op_title']);
                 $items=$v['items'];
                 $questions='';
                 if($items){
                    foreach ($items as $k => $v) {
                         $color=$colors[$k];
                         $labelClass='label-'.$color;
                         $progressClass='progress-bar-'.$color;                     
                         $mark=Html::tag('span',$keys[$k],['class'=>'label '.$labelClass]); 
                         $label=Html::tag('label',$v['title'],['class'=>'control-label']);                    
                         $question=\yii\bootstrap\Progress::widget([
                            'percent' => 20,
                            'label' => $v['num'],
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
    /**
     * 格式化问卷
     * @param array $soptions
     * @return string
     */
    private function _formatQuestion($soptions) {
        $html='';
        $options=$soptions['soptions'];
        if(!empty($options)){
            foreach ($options as $k=>$v) {
                 $title=  Html::tag('h2', ($k+1).'.'.$v['op_title']);
                 $input=$v['sshow']=='c'?'checkboxList':'radioList';
                 $name='op_contents['.$v['id'].'][]';
                 $items=$v['items'];
                 $question='没有选项';
                 if($items){
                    $items=\yii\helpers\ArrayHelper::getColumn($items,'title');
                    $question=Html::$input($name,null,$items,['itemOptions'=>['labelOptions'=>['class'=>'help-block']]]);                  
                 }
                $html.= Html::tag('div',$title.$question,['class'=>'form-group']);
            }
           
        }
        return $html;
    }
    /**
     * Deletes an existing Stitle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stitle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stitle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stitle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
