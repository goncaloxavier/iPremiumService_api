<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Autenticacao',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uv1sIOh148L_FDsSy4OH7PuE9SblRzkb',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com', //Se falhar usar ip v4…
                'username' => 'gonalovenancio@gmail.com',
                'password' => 'MentalIssues45',
                'port' => '465', //465 ou 587',
                'encryption' => 'ssl', //ssl ou tls
            ],
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
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['avarias','utilizadores','dispositivos', 'relatorios'],
                    'pluralize' => false,
                    'tokens' => [
                        '{idvalidacao}'=>'<idvalidacao:\\w+>',
                        '{nomeutilizador}' =>'<nomeutilizador:\\w+>',
                        '{user}'=>'<user:\\w+>',
                        '{referencia}'=>'<referencia:\\w+>',
                        '{estado}'=>'<estado:\\w+>',
                        '{palavrapasse}' => '<palavrapasse:\\w+>',
                        '{mes}'=>'<mes:\\w+>',
                        '{gravidade}'=>'<gravidade:\\w+>',
                        '{id}'=>'<id:\\w+>',
                    ],
                    'extraPatterns' =>
                    [
                        'GET validacao/{idvalidacao}' => 'validacao',
                        'GET auth/{nomeutilizador}/{palavrapasse}' => 'auth',
                        'GET byuser/{user}' => 'byuser',
                        'GET byref/{referencia}' => 'byref',
                        'GET byestado/{estado}' => 'byestado',
                        'GET bygravidade/{referencia}/{gravidade}' => 'bygravidade',
                        'GET estatistica/{mes}' => 'estatistica',
                    ]
                ]
            ],
        ],
    ]
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
