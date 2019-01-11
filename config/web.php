<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Sistem PKL',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 't5B5QGw3KxcurEu8_TZQmAcHel4uaJuZ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],

    ],
    'modules' => [

        'pkl' => [
            'class' => 'app\modules\pkl\Module',
        ],
        'mitrapkl' => [
            'class' => 'app\modules\mitrapkl\Module',
        ],
        'topikpkl' => [
            'class' => 'app\modules\topikpkl\Module',
        ],
        'kategoripkl' => [
            'class' => 'app\modules\kategoripkl\Module',
        ],
        'pengajuanpkl' => [
            'class' => 'app\modules\pengajuanpkl\Module',
        ],
        'logpkl' => [
            'class' => 'app\modules\logpkl\Module',
        ],
        'detailpkl' => [
            'class' => 'app\modules\detailpkl\Module',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
        ],
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'your-host-domain e.g. smtp.gmail.com',
                'username' => 'your-email-or-username',
                'password' => 'your-password',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

    ],
    'params' => $params,
    // 'as beforeRequest' => [
    //     'class' => 'yii\filters\AccessControl',
    //     'rules' => [
    //         [
    //             'actions' => ['login', 'error'],
    //             'allow' => true,
    //         ],
    //         [
    //             'roles' => ['@'],
    //             'allow' => true,
    //         ]
    //     ]
    // ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            '*',
        ]
    ],
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
