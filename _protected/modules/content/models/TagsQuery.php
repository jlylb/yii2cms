<?php

namespace content\models;
use creocoder\taggable\TaggableQueryBehavior;
/**
 * This is the ActiveQuery class for [[Tags]].
 *
 * @see Tags
 */
class TagsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     * @return Tags[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tags|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
