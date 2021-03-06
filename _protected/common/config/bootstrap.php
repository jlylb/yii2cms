<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@data', dirname(dirname(dirname(__DIR__))) . '/data');

Yii::setAlias('@core', dirname(dirname(__DIR__)) . '/modules');
Yii::setAlias('@content',   '@core/content');
Yii::setAlias('@survey',   '@core/survey');
Yii::setAlias('@comments',  '@core/comments');
Yii::setAlias('@upload',  '@core/upload');
Yii::setAlias('@widget',  '@core/widget');

Yii::setAlias('@yii2mod/comments', dirname(dirname(__DIR__)). '/vendor/yii2mod/yii2-comments');
Yii::setAlias('@yii2mod/behaviors', dirname(dirname(__DIR__)) . '/vendor/yii2mod/yii2-behaviors');
