<?php

namespace backend\modules\survey\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\survey\models\Stitle;

/**
 * StitleSearch represents the model behind the search form about `backend\modules\survey\models\Stitle`.
 */
class StitleSearch extends Stitle
{
    public function rules()
    {
        return [
            [['id', 'num', 'is_auth', 'is_status', 'uid'], 'integer'],
            [['title', 'time'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Stitle::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'num' => $this->num,
            'is_auth' => $this->is_auth,
            'is_status' => $this->is_status,
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'time', $this->time]);

        return $dataProvider;
    }
    
    public function searchOptions($id)
    {
        $query = Stitle::find();

//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);

//        if (!($this->load($params) && $this->validate())) {
//            return $dataProvider;
//        }
        
        $query->joinWith('soptions.items');
                
        $query->andWhere([
            '{{%stitle}}.id' =>$id,
            'is_auth' => 1,
            'is_status' => 1,
           // 'uid' => $this->uid,
        ]);
        
        $re=$query->asArray()->all();

        return $re;
    }
}
