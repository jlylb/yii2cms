<?php

namespace upload\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use upload\models\Attachment;

/**
 * AttachmentSearch represents the model behind the search form about `upload\models\Attachment`.
 */
class AttachmentSearch extends Attachment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'size', 'order', 'created_at'], 'integer'],
            [['entity_model', 'path', 'type', 'name'], 'safe'],
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
        $query = Attachment::find();

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
            'entity_id' => $this->entity_id,
            'size' => $this->size,
            'order' => $this->order,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'entity_model', $this->entity_model])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}