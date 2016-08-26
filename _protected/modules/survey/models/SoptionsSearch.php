<?php

namespace backend\modules\survey\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\survey\models\Soptions;

/**
 * SoptionsSearch represents the model behind the search form about `backend\modules\survey\models\Soptions`.
 */
class SoptionsSearch extends Soptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid'], 'integer'],
            [['op_title', 'op_contents', 'sshow'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Soptions::find()->innerJoinWith('stitle');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sid' => $this->sid,
        ]);

        $query->andFilterWhere(['like', 'op_title', $this->op_title])
            ->andFilterWhere(['like', 'sshow', $this->sshow]);

        return $dataProvider;
    }
}
