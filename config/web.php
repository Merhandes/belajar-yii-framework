<?php

use yii\web\JsonParser;
use yii\bootstrap5\BootstrapAsset;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Hello World',
    'language' => 'id',
    // 'defaultRoute' => 'site/login',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    // 'defaultRoute' => 'my-article/hello-world',
    'aliases' => [
        // '@web' => '@vendor/bower-asset',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'FQT3FU_-qWE54Oq_Ri9TNeIqDbcXVvOT',
            'parsers' => [
                'application/json' => JsonParser::class
            ]
        ],
        // 'cache' => [
        //     'class' => 'yii\caching\FileCache',
        // ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        // 'errorHandler' => [
        //     'errorAction' => 'site/error',
        // ],
        // 'mailer' => [
        //     'class' => \yii\symfonymailer\Mailer::class,
        //     'viewPath' => '@app/mail',
        //     // send all mails to a file by default.
        //     'useFileTransport' => true,
        // ],
        // 'log' => [
        //     'traceLevel' => YII_DEBUG ? 3 : 0,
        //     'targets' => [
        //         [
        //             'class' => 'yii\log\FileTarget',
        //             'levels' => ['error', 'warning'],
        //         ],
        //     ],
        // ],
        // 'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'assetManager' => [
            // 'class' => 'app\components\AssetManager'
            'linkAssets' => false,
            'appendTimestamp' => true,
            'bundles' => [
                BootstrapAsset::class => [
                    'css' => [
                        '/vendor/bootstrap/css/bootstrap.min.css'
                    ]
                ]
            ]
        ],
        'test' => function(){
            return new app\components\TestComponent();
        }
    ],
    'params' => $params,
    // 'on beforeRequest' => function(){
    //     echo '<pre><br><br><br>';
    //     var_dump("From before request");
    //     echo '</pre>';
    // }
    // 'on beforeAction' => function(){
    //     echo '<pre>';
    //     var_dump("Application before action");
    //     echo '</pre>';

    //     Yii::$app->controller->on(\yii\web\Controller::EVENT_AFTER_ACTION, function(){
    //         echo '<pre>';
    //         var_dump("Controller before action from ->on method");
    //         echo '</pre>';
    //     });
    // }
    // 'on beforeAction' => function(){
    //     echo Yii::$app->view->render('@app/views/page/about');
    // }
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
