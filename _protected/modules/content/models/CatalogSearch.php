<?php

namespace content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use content\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form about `content\models\Catalog`.
 */
class CatalogSearch extends Catalog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid', 'sort_num'], 'integer'],
            [['catalog_english', 'catalog_name', 'status', 'create_time'], 'safe'],
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
        $query = Catalog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pid' => $this->pid,
            'sort_num' => $this->sort_num,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'catalog_english', $this->catalog_english])
            ->andFilterWhere(['like', 'catalog_name', $this->catalog_name])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
