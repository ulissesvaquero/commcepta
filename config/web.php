<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'commcepta',
    'name' => 'Commcepta Teste',
    'language' => 'pt-BR',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
            // see settings on http://demos.krajee.com/datecontrol#module
        ],
        // If you use tree table
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // see settings on http://demos.krajee.com/tree-manager#module
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9cAYcgryum-T7-4vSkLLRi1lGh7RdzKH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
        'formatter' => [
            'class' => 'yii\i18n\formatter',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'dateFormat' => 'dd/MM/yyyy',
            'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
            'currencyCode' => '',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
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
        'generators' => [ //here
            'crud-traduzido' => [ // generator name
                'class' => 'mootensai\enhancedgii\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'traducao' => '@app/gii/crud/default', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
