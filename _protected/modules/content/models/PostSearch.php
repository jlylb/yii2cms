<?php

namespace content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use content\models\Post;

/**
 * PostSearch represents the model behind the search form about `content\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'catalog_link', 'view_num', 'favorite_num', 'focus_num', 'comment_num'], 'integer'],
            [['title', 'intro', 'content', 'author', 'tags', 'seo_title', 'seo_keywords', 'seo_desc', 'copy_from', 'copy_url', 'allow_comment', 'status', 'first_img', 'attach', 'create_time', 'update_time'], 'safe'],
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
        $query = Post::find();

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
            'uid' => $this->uid,
            'catalog_link' => $this->catalog_link,
            'view_num' => $this->view_num,
            'favorite_num' => $this->favorite_num,
            'focus_num' => $this->focus_num,
            'comment_num' => $this->comment_num,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_desc', $this->seo_desc])
            ->andFilterWhere(['like', 'copy_from', $this->copy_from])
            ->andFilterWhere(['like', 'copy_url', $this->copy_url])
            ->andFilterWhere(['like', 'allow_comment', $this->allow_comment])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'first_img', $this->first_img])
            ->andFilterWhere(['like', 'attach', $this->attach]);

        return $dataProvider;
    }
}
