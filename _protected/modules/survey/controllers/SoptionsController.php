<?php

namespace survey\controllers;

use Yii;
use survey\models\Soptions;
use survey\models\Stitle;
use survey\models\SoptionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SoptionsController implements the CRUD actions for Soptions model.
 */
class SoptionsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'vote'=>[
                'class'=>'backend\modules\survey\actions\VoteAction',
            ]
        ];
    }
    /**
     * Lists all Soptions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SoptionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Soptions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionTitles()
    {
        $title=Yii::$app->request->get('q','');
        \Yii::$app->response->format =Response::FORMAT_JSON;
        $query = Stitle::find();
        $query->andFilterWhere(['like', 'title', $title]);            
        $ret= $query->select(['id','title text'])->asArray()->all();
        return $ret;
    }
    /**
     * Creates a new Soptions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Soptions();
        $stitle='';
        $title='';
        $id=Yii::$app->request->get('sid','');
        $id and $title=Stitle::findOne($id);
        if($title){
            $model->sid=$id;
            $stitle=$title->title;
        }else{
           $id=''; 
        }
        
        $post=Yii::$app->request->post();
        if ($model->load($post) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'stitle'=> $stitle,
                'id'=> $id,
            ]);
        }
    }

    /**
     * Updates an existing Soptions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post=Yii::$app->request->post();
        if ($model->load($post) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Soptions model.
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
     * Finds the Soptions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Soptions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Soptions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
