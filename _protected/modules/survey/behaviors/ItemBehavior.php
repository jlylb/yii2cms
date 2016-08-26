<?php
namespace backend\modules\survey\behaviors;
/**
 * Created by PhpStorm.
 * User: CPR061
 * Date: 2016/8/9
 * Time: 16:26
 */

use yii\base\Behavior;
use yii;
use yii\db\ActiveRecord;
//use backend\modules\survey\models\SoptionsItem;
use yii\helpers\ArrayHelper;

class ItemBehavior  extends Behavior{

    public $attribute='itemAttribute';

    public $relationName='items';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE=>'afterDelete',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterUpdate',
        ];
    }

    public function afterDelete($event){
        $relation=$this->owner->getRelation($this->relationName);
        $class = $relation->modelClass;
        $linkId=key($relation->link);
        $class::deleteAll([$linkId => $this->owner->getPrimaryKey()]);
    }

    public function afterUpdate($event){

        $relation=$this->owner->getRelation($this->relationName);

        $pk=current($relation->link);

        

        $class = $relation->modelClass;

        $itemData=$this->owner->{$this->attribute};

        if(!$itemData){
            return false;
        }
        
        $relationItems=$diff=[];
        
        if(!$this->owner->getIsNewRecord()){
            
            $relationItems=$relation->all();

            $ids =ArrayHelper::getColumn($relationItems,$pk) ;

            $postIds=array_keys($itemData) ;

            $diff = array_diff($ids,$postIds); 
        }

        foreach($itemData as $key=>$data){
            $isFind=false;
            if($relationItems){
                foreach($relationItems as $item){
                    $itemPk=$item->{$pk};
                    if($itemPk==$key){
                        $isFind=true;
                        $itemModel=$item;
                    }
                    if($diff && in_array($itemPk,$diff)){
                        $item->delete();
                    }
                }
            }
            if(!$isFind){
                $itemModel=new $class();
                $itemModel->{key($relation->link)}=$this->owner->getPrimaryKey();
            }
            $itemModel->load($data,'');
            $itemModel->save();
        }
        unset($this->owner->{$this->relationName});

    }

} 