<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

use yii2mod\comments\models\CommentModel;

class Comment extends CommentModel{
    
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[
            'commentNum'=>[
                'class' => 'common\behaviors\CommentBehavior',
            ],
        ]);
    }
    public function getAvatar()
    {
        
    }
}
