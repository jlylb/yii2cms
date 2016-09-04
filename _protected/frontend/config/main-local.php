<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'STajU_abO2tSsQEvNj2KJpCW5qox9v6u',
        ],
        'assetManager' => [
            'bundles' => [
                 'yii\bootstrap\BootstrapAsset' => [
                     'basePath' => '@webroot',   // do not use file from our server
                     'baseUrl' => '@web/themes/zui',
                     'css' => [
                         'css/zui.min.css',
                         ]
                 ],
                 'yii\bootstrap\BootstrapPluginAsset' => [
                     'basePath' => '@webroot',
                     'baseUrl' =>  '@web/themes/zui',   // do not use file from our server
                     'js' => [
                         'js/zui.js'
                         ]
                 ],
                'yii\web\JqueryAsset' => [
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/themes/zui',   // do not use file from our server
                    'js' => [
                        'lib/jquery/jquery.js',
                    ]
                ],
            ],
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
