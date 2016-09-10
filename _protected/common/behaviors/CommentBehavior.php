<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;


class CommentBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }
    
    public function afterInsert($event) {
        $model=Yii::createObject($this->owner->entity);
        $key=$model->primaryKey();
        $model->updateAllCounters(['comment_num'=>1],[reset($key)=>$this->owner->entityId]);  
    }
    
    public function afterDelete($event) {
        
        $model=Yii::createObject($this->owner->entity);
        $key=$model->primaryKey();
        $model->updateAllCounters(['comment_num'=>-1],[reset($key)=>$this->owner->entityId]);   
        
    }
    
}
