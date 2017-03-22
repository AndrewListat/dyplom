<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uP07RMYTowSeEIW310VQfKpoKbOS6acl',
			'baseURL'=>'',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\ls_admin\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['app/signin'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport' => [
                'class' => 'Swift_MailTransport',
            ],
            'useFileTransport' => false,
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
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                'elfinder/<action>' => 'elfinder/<action>',
                'app' => 'ls_admin/default/index',
                'app/<action>' => 'ls_admin/default/<action>',
                'app/<controller:\w+>/<action:\w+>' => 'ls_admin/<controller>/<action>',
                'api/<action:\w+>' => 'api/<action>',
                'client/<action:\w+>' => 'client/<action>',
                '<action:\w+>/<slug:[A-Za-z0-9 -_./]+>/<id:\d+>' => 'site/<action>',
                '<action:\w+>/<slug:[A-Za-z0-9 -_./]+>' => 'site/<action>',

                '<action:\w+>' =>'site/<action>',
            ],
        ],
        
    ],
	'modules' => [
        'ls_admin' => [
            'class' => 'app\modules\ls_admin\Module',
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl'=>'@web',
                'basePath'=>'@webroot',
                'path' => 'upload/images',
                'name' => 'Images'
            ],
////            'watermark' => [
////                'source'         => __DIR__.'/logo.png', // Path to Water mark image
////                'marginRight'    => 5,          // Margin right pixel
////                'marginBottom'   => 5,          // Margin bottom pixel
////                'quality'        => 95,         // JPEG image save quality
////                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
////                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
////                'targetMinPixel' => 200         // Target image minimum pixel size
////            ]
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
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
