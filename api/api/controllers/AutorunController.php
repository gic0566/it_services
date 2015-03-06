<?php

namespace app\controllers;

use yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CompanyUser;
use app\models\Task;
use app\models\TaskUser;
use app\models\ExpertUser;
use app\models\Skill;

class AutorunController extends ActiveController {

    var $image_ip = 'http://121.40.33.243:8888/';
    public $modelClass = '';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    var $arr = array('errno' => '1', 'data' => array());

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

    /**
     * 地图上获取专家数据-心跳更新
     */
    function actionMapExpertNow() {
        $post_arr = Yii::$app->request->post();
        $area_x = isset($post_arr['area_x']) ? $post_arr['area_x'] : ''; //纬度
        $area_y = isset($post_arr['area_y']) ? $post_arr['area_y'] : ''; //经度
        $skill = isset($post_arr['skill']) ? $post_arr['skill'] : '0';
        if (empty($area_x)) {
            return;
        }
        if (empty($area_y)) {
            return;
        }
        $query = (new \yii\db\Query())
                ->select('eu.true_name,eu.logo elogo,eu.area_x,eu.area_y,eu.id auto_id,u.id uid,eu.comment_score,eu.login_time')
                ->from('it_expert_user eu,it_user u');
        $query->where('eu.uid=u.id');
        if (!empty($skill)) {
            $query->andFilterWhere(array('like', 'skill', ',' . $skill . ','));
        }
        $data = $query->all();
        if (is_array($data) && !empty($data)) {
            foreach ($data AS $k => $v) {
                if (empty($v['area_x'])) {
                    unset($data[$k]);
                    continue;
                }
                if (empty($v['area_y'])) {
                    unset($data[$k]);
                    continue;
                }
                $data[$k]['elogo'] = $this->image_ip . $v['elogo'];

                //计算距离
                $distance = $this->getDistance($area_x, $area_y, $v['area_x'], $v['area_y']);
                if ($distance > 100) {//100公里以内的专家
                    unset($data[$k]);
                    continue;
                }
                $data[$k]['comment_level'] = '4';
                //判断用户是否在线
                $data[$k]['online_status'] = (time() - $v['login_time']) > 3600 ? 'off' : 'on';
            }
        }
        $this->arr['data'] = array_values($data);
        return $this->arr;
    }

    /**
     * 地图上获取公司数据-心跳更新
     */
    function actionMapCompanyNow() {

        $post_arr = Yii::$app->request->post();
        $area_x = isset($post_arr['area_x']) ? $post_arr['area_x'] : ''; //纬度
        $area_y = isset($post_arr['area_y']) ? $post_arr['area_y'] : ''; //经度
        $skill = isset($post_arr['skill']) ? intval($post_arr['skill']) : '0';
        if (empty($area_x)) {
            return;
        }
        if (empty($area_y)) {
            return;
        }
        $query = (new \yii\db\Query())
                ->select('cu.logo clogo,cu.area_x,cu.area_y,cu.id auto_id,u.id uid')
                ->from('it_company_user cu,it_user u');
        $query->where('cu.uid=u.id');

        $data = $query->all();
        if (is_array($data) && !empty($data)) {
            foreach ($data AS $k => $v) {
                if (empty($v['area_x'])) {
                    unset($data[$k]);
                    continue;
                }
                if (empty($v['area_y'])) {
                    unset($data[$k]);
                    continue;
                }
                $data[$k]['clogo'] = $this->image_ip . $v['clogo'];

                //计算距离
                $distance = $this->getDistance($area_x, $area_y, $v['area_x'], $v['area_y']);
                if ($distance > 100) {//100公里以内的公司
                    unset($data[$k]);
                    continue;
                }
                //获取需求数
                $query = Task::find()->where('uid=' . $v['uid'])->andWhere('status=0');
                if (!empty($skill)) {
                    $query->andWhere('category=' . $skill);
                }
                $task_num = $query->count();
                $data[$k]['task_num'] = $task_num;
            }
        }
        $this->arr['data'] = array_values($data);
        return $this->arr;
    }

    /**
     * ------------------------------------------------工具方法---------------------------------------------------------
     */

    /**
     * @desc 根据两点间的经纬度计算距离 
     * @param float $lat 纬度值 
     * @param float $lng 经度值 
     */
    function getDistance($lat1, $lng1, $lat2, $lng2) {
        $earthRadius = 6367000; //approximate radius of earth in meters 

        /*
          Convert these degrees to radians
          to work with the formula
         */

        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;

        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;


        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance / 1000); //千米（公里）
    }

    /**
     * 获取专家擅长
     */
    function expertSkill($id = '0') {
        $skill_data = Skill::find()->select('id,name,parent_id')->asArray()->all();

        $data = $this->tree($skill_data, $id);
        if (!empty($id)) {
            $str = '';
            if (is_array($data) && !empty($data)) {
                foreach ($data as $v) {
                    $str.=$v['name'] . ' ';
                    if (isset($v['children'])) {
                        foreach ($v['children'] as $v1) {
                            $str.=$v1['name'] . ' ';
                        }
                    }
                    $str.=',';
                }
            }
            return rtrim($str, ',');
        } else {
            return $data;
        }
    }

}
