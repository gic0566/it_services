<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'X-vGvNDtkWjGPjGHbyxrrA-dvp2Rrcly',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=it_service',
            'username' => 'root',
            'password' => 'ixungou20141231',
            'charset' => 'utf8',
            'tablePrefix' => 'it_'
        ],
        'urlManager' => [
            'enablePrettyUrl' => TRUE,
            'enableStrictParsing' => TRUE,
            'showScriptName' => false,
//            'suffix'=>'.html',  //后缀
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'extraPatterns' => [
                        'GET skill-all' => 'skill-all', //获取专家分类数据
                        'GET company-list' => 'company-list', //公司列表
                        'GET expert-list' => 'expert-list', //专家列表
                        'GET company-detail' => 'company-detail', //公司详情
                        'GET expert-detail' => 'expert-detail', //专家详情
                        'POST company-register' => 'company-register', //公司注册
                        'POST expert-register' => 'expert-register', //专家注册
                        'POST update-company-logo' => 'update-company-logo', //上传公司头像
                        'POST update-expert-logo' => 'update-expert-logo', //上传专家头像
                        'POST update-company-info' => 'update-company-info', //修改公司资料
                        'POST update-expert-info' => 'update-expert-info', //修改专家资料
                        'POST login' => 'login', //登录
                        'POST find-pwd' => 'find-pwd', //忘记密码
                        'POST update-company-areaxy' => 'update-company-areaxy', //更新公司地理位置
                        'POST update-expert-areaxy' => 'update-expert-areaxy', //更新专家的地理位置
                        'POST update-company-areaxy' => 'update-company-areaxy', //更新公司的地理位置
                    ],
                    'pluralize' => false
                ],
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'task',
                    'extraPatterns' => [
                        'GET list' => 'list', //专家需求列表
                        'GET expert-skill' => 'expert-skill', //获取专长
                        'GET detail' => 'detail', //需求详情
                        'GET apply-expert-list' => 'apply-expert-list', //申请专家列表
                        'POST publish-new' => 'publish-new', //发布新需求
                        'POST modify' => 'modify', //修改需求
                        'POST expert-apply' => 'expert-apply', //专家提交申请
                        'POST company-to-expert-comment' => 'company-to-expert-comment', //公司评价专家
                        'POST expert-to-company-comment' => 'expert-to-company-comment', //专家评价公司
                        'POST company-accept-expert' => 'company-accept-expert', //公司接受专家申请
                        'POST update-status' => 'update-status', //更新项目状态
                    ],
                    'pluralize' => false
                ],
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'autorun',
                    'extraPatterns' => [
                        'POST map-expert-now' => 'map-expert-now', //地图上获取专家数据-心跳更新
                        'POST map-company-now' => 'map-company-now' //地图上获取公司数据-心跳更新
                    ],
                    'pluralize' => false
                ],
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'test',
                    'extraPatterns' => [
                        'GET index1' => 'index1', //test
                    ],
                    'pluralize' => false
                ]
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    'weight' => 60,
                ],
            ],
        ]
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
