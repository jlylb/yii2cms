<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/5/14
 * Time: 10:46 AM
 */

namespace widget\models;

use yii\db\ActiveQuery;

class TimelineEventQuery extends ActiveQuery
{
    public function today()
    {
        $this->andWhere(['>=', 'created_at', strtotime('today midnight')]);
        return $this;
    }
}
