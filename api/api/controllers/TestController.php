<?php

namespace app\controllers;

use yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CompanyUser;
use yii\caching\MemCache;
use \common\models\ApiTool;

//use yii\log;

class TestController extends ActiveController {

    public $modelClass = '';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors() {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
//                    'application/xml' => Response::FORMAT_XML,
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'create' => ['post'],
                    'update' => ['post'],
                    'delete' => ['delete'],
                    'deleteall' => ['post'],
                ]
            ]
        ];
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);
        return $actions;
    }

    public function actionIndex1() {
//        \Yii::$app->cache->memcache->init();
//        Yii::$app->cache->memcache->setValue('12', 'asdfasdfasdf', 3600);
//        return Yii::$app->cache->memcache->getValue('12');
//       echo md5((time() . '_' . (microtime() * 1000000)));
//        yii::getLogger()->log('asdfasdfsadf', log\Logger::LEVEL_ERROR);
//        \yii::info('123131312');
//        echo urldecode('%E8%94%A1%E9%B9%8F');

        echo ApiTool::image_ip;
    }

}
