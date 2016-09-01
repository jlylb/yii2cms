<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'datetimeFormat'=>'php:Y-m-d H:i:s',
            'dateFormat'=>'php:Y-m-d',
            'timeFormat'=>'php:H:i:s',
        ],
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
                'filekit/widget' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap'=>[
                        'filekit/widget'=>'widget.php'
                    ],
                ],
            ],
        ],
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '@web/data/uploads',
            'filesystem' => [
                'class' => 'upload\components\LocalFlysystemBuilder',
                'path' => '@webroot/data/uploads'
            ],
//            'as log' => [
//                'class' => 'common\behaviors\FileStorageLogBehavior',
//                'component' => 'fileStorage'
//            ]
        ],
    ],
];
