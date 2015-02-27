<?php

namespace app\controllers;

use yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CompanyUser;
use app\models\User;
use app\models\ExpertUser;
use app\models\Skill;
use app\models\Task;
use yii\web\NotFoundHttpException;
use \common\models\ApiTool;

//use yii\db\Connection;

class UserController extends ActiveController {

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
            ],
//            'authenticator' => [
//                'class' => HttpBasicAuth::className(),
//            ]
        ];
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);
        return $actions;
    }

    /**
     * 公司注册
     */
    public function actionCompanyRegister() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $name = isset($post_arr['name']) ? $post_arr['name'] : '';
        $password = isset($post_arr['pwd']) ? md5($post_arr['pwd']) : '';

        $short_name = isset($post_arr['s_name']) ? $post_arr['s_name'] : '';
        $company_name = isset($post_arr['c_name']) ? $post_arr['c_name'] : '';
        $province = isset($post_arr['province']) ? $post_arr['province'] : '';
        $city = isset($post_arr['city']) ? $post_arr['city'] : '';
        $district = isset($post_arr['district']) ? $post_arr['district'] : '';
        $address = isset($post_arr['address']) ? $post_arr['address'] : '';
        $contacts = isset($post_arr['contacts']) ? $post_arr['contacts'] : '';
        $job = isset($post_arr['job']) ? $post_arr['job'] : '';
        $mobile = isset($post_arr['mobile']) ? $post_arr['mobile'] : '';
        $summary = isset($post_arr['summary']) ? $post_arr['summary'] : '';
        $email = isset($post_arr['email']) ? $post_arr['email'] : '';
        $area_x = isset($post_arr['area_x']) ? $post_arr['area_x'] : '';
        $area_y = isset($post_arr['area_y']) ? $post_arr['area_y'] : '';
        $privacy = isset($post_arr['privacy']) ? intval($post_arr['privacy']) : '0';

        $upload = $this->uploadedFile('photo');

        //判断是否有重复用户
        $total = User::find()->where('name="' . $name . '"')->count();
        if (!empty($total)) {
            $this->arr['errno'] = '99';
        }

        if ($this->arr['errno'] == '1' && !empty($name) && !empty($password)) {
            $user_model = new User();
            $user_model->name = $name;
            $user_model->password = $password;
            $user_model->role = '1';
            if ($user_model->insert()) {

                $uid = $user_model->primaryKey;
                //插入专家用户表
                $model = new CompanyUser();
                $model->uid = $uid;

                $model->add_time = time();
                $model->short_name = $short_name;
                $model->company_name = $company_name;
                $model->province = $province;
                $model->city = $city;
                $model->district = $district;
                $model->address = $address;
                $model->contacts = $contacts;
                $model->job = $job;
                $model->email = $email;
                $model->mobile = $mobile;
                $model->privacy = $privacy;
                $model->summary = $summary;
                $model->area_y = $area_y;
                $model->area_x = $area_x;

                if (!empty($upload)) {
                    $tmp_arr = explode('.', $upload->name);
                    $save_name = md5($uid . '_' . mt_rand(10, 99)) . '.' . end($tmp_arr);
                    $uploadpath = $this->fileExists('/data/resource/user/head/');
                    @unlink($uploadpath . $save_name);
                    $upload->saveAs($uploadpath . $save_name);
                    $model->logo = 'user/head/' . $save_name;
                }

                if (!$model->insert()) {
                    $this->arr['errno'] = '0';
                } else {
                    $auto_id = $model->primaryKey;
                    $this->arr['data'] = array(
                        'uid' => $uid,
                        'auto_id' => $auto_id,
                        'name' => $name,
                        'new_user_score' => '100',
                        'login_score' => '20'
                    );
                }
            }
        }

        return $this->arr;

//        throw new NotFoundHttpException('message',400);
    }

    /**
     * 专家注册
     */
    public function actionExpertRegister() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $name = isset($post_arr['name']) ? $post_arr['name'] : '';
        $password = isset($post_arr['pwd']) ? md5($post_arr['pwd']) : '';

        $short_name = isset($post_arr['s_name']) ? $post_arr['s_name'] : '';
        $true_name = isset($post_arr['t_name']) ? $post_arr['t_name'] : '';
        $province = isset($post_arr['province']) ? $post_arr['province'] : '';
        $city = isset($post_arr['city']) ? $post_arr['city'] : '';
        $district = isset($post_arr['district']) ? $post_arr['district'] : '';
        $address = isset($post_arr['address']) ? $post_arr['address'] : '';
        $skill = isset($post_arr['skill']) ? intval($post_arr['skill']) : '0';
        $length_service = isset($post_arr['service']) ? $post_arr['service'] : '0';
        $mobile = isset($post_arr['mobile']) ? $post_arr['mobile'] : '';
        $email = isset($post_arr['email']) ? $post_arr['email'] : '';
        $area_x = isset($post_arr['area_x']) ? $post_arr['area_x'] : '';
        $area_y = isset($post_arr['area_y']) ? $post_arr['area_y'] : '';
        $summary = isset($post_arr['summary']) ? $post_arr['summary'] : '';
//        print_r($post_arr);exit;
        $upload = $this->uploadedFile('photo');

        //判断是否有重复用户
        $total = User::find()->where('name="' . $name . '"')->count();
        if (!empty($total)) {
            $this->arr['errno'] = '99';
        }

        if ($this->arr['errno'] == '1' && !empty($name) && !empty($password)) {
            $user_model = new User();
            $user_model->name = $name;
            $user_model->password = $password;
            $user_model->role = '2';
            if ($user_model->insert()) {

                $uid = $user_model->primaryKey;
                //插入专家用户表
                $model = new ExpertUser();
                $model->uid = $uid;

                $model->add_time = time();
                $model->short_name = $short_name;
                $model->true_name = $true_name;
                $model->province = $province;
                $model->city = $city;
                $model->district = $district;
                $model->address = $address;
                $model->skill = $skill;
                $model->length_service = $length_service;
                $model->email = $email;
                $model->mobile = $mobile;
                $model->summary = $summary;
                $model->area_y = $area_y;
                $model->area_x = $area_x;

                if (!empty($upload)) {
                    $tmp_arr = explode('.', $upload->name);
                    $save_name = md5($uid . '_' . mt_rand(10, 99)) . '.' . end($tmp_arr);
                    $uploadpath = $this->fileExists('/data/resource/user/head/');
                    @unlink($uploadpath . $save_name);
                    $upload->saveAs($uploadpath . $save_name);
                    $model->logo = 'user/head/' . $save_name;
                }

                if (!$model->insert()) {
                    $this->arr['errno'] = '0';
                } else {
                    $auto_id = $model->primaryKey;
                    $this->arr['data'] = array(
                        'uid' => $uid,
                        'auto_id' => $auto_id,
                        'name' => $name,
                        'new_user_score' => '100',
                        'login_score' => '20'
                    );
                }
            }
        }

        return $this->arr;
    }

    /**
     * 上传公司头像
     */
    public function actionUpdateCompanyLogo() {
        $post_arr = Yii::$app->request->post();
        $id = isset($post_arr['auto_id']) ? intval($post_arr['auto_id']) : '';
        $upload = $this->uploadedFile('photo');
        
        if (empty($id)) {
            $this->arr['errno'] = '0';
        }
        if (empty($upload)) {
            $this->arr['errno'] = '0';
        }
        if ('1' == $this->arr['errno']) {
            $model = CompanyUser::findOne($id);
            if (!empty($upload) && !empty($model)) {
                $tmp_arr = explode('.', $upload->name);
                $save_name = md5($model->uid . '_' . mt_rand(10, 99)) . '.' . end($tmp_arr);
                $uploadpath = $this->fileExists('/data/resource/user/head/');
                @unlink($uploadpath . $save_name);
                $upload->saveAs($uploadpath . $save_name);
                $model->logo = 'user/head/' . $save_name;
                if(!$model->update()){
                    $this->arr['errno'] = '0';
                }
            }
        }

        return $this->arr;
    }

    /**
     * 上传专家头像
     */
    public function actionUpdateExpertLogo() {
        $post_arr = Yii::$app->request->post();
        $id = isset($post_arr['auto_id']) ? intval($post_arr['auto_id']) : '';
        $upload = $this->uploadedFile('photo');
        if (empty($id)) {
            return;
        }
        if (empty($upload)) {
            return;
        }

        $model = ExpertUser::findOne($id);
        if (!empty($upload) && !empty($model)) {
            $tmp_arr = explode('.', $upload->name);
            $save_name = md5($model->uid . '_' . mt_rand(10, 99) . '.' . end($tmp_arr));
            $uploadpath = $this->fileExists('/data/resource/user/head/');
            @unlink($uploadpath . $save_name);
            $upload->saveAs($uploadpath . $save_name);
            $model->logo = 'user/head/' . $save_name;
            if (!$model->update()) {
                $this->arr['errno'] = '0';
            }
        }

        return $this->arr;
    }

    /**
     * 忘记密码
     */
    public function actionFindPwd() {
        
    }

    /**
     * 用户登录
     */
    public function actionLogin() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $name = isset($post_arr['name']) ? $post_arr['name'] : '';
        $area_x = isset($post_arr['area_x']) ? $post_arr['area_x'] : '';
        $area_y = isset($post_arr['area_y']) ? $post_arr['area_y'] : '';
        $password = isset($post_arr['pwd']) ? md5($post_arr['pwd']) : '';
        if (!empty($name) && !empty($password)) {
            $data = User::find()->select('id,role')->where('name="' . $name . '"')->andWhere('password="' . $password . '"')->asArray()->one();
            if (is_array($data) && !empty($data)) {
                if ('1' == $data['role']) {
                    $user_data = CompanyUser::find()->where('uid=' . $data['id'])->asArray()->one();
                    $model = CompanyUser::findOne($user_data['id']);
                    if ($model) {
                        $model->login_time = time();
                        $model->area_x = $area_x;
                        $model->area_y = $area_y;
                        if (!$model->update()) {
                            $this->arr['errno'] = '0';
                        }
                    }
                } elseif ('2' == $data['role']) {
                    $user_data = ExpertUser::find()->where('uid=' . $data['id'])->asArray()->one();
                    $model = ExpertUser::findOne($user_data['id']);
                    if ($model) {
                        $model->login_time = time();
                        $model->area_x = $area_x;
                        $model->area_y = $area_y;
                        if (!$model->update()) {
                            $this->arr['errno'] = '0';
                        }
                    }
                }
                $user_data['auto_id'] = $user_data['id'];
                $user_data['logo'] = $this->image_ip . $user_data['logo'];
                $this->arr['data'] = $user_data;
            } else {
                $this->arr['errno'] = '98';
            }
        }

        return $this->arr;
    }

    /**
     * 公司列表
     * @return type
     */
    public function actionCompanyList($sort = '0', $from = '0', $limit = '10') {
        $query = (new \yii\db\Query())
                ->select('cu.id auto_id,cu.uid,cu.short_name,cu.company_name,cu.logo clogo,cu.id auto_id,u.id uid')
                ->from('it_company_user cu,it_user u');
        $query->where('u.id=cu.uid');

        $query1 = clone $query;
        $total = $query1->count();

        $query->orderBy('u.id DESC');

        $data = $query->offset(intval($from))
                ->limit(intval($limit))
                ->all();
        if (is_array($data) && !empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['clogo'] = $this->image_ip . $v['clogo'];
            }
        }
        $this->arr['data']['total'] = $total;
        $this->arr['data']['list'] = $data;
        return $this->arr;
    }

    /**
     * 公司详情
     */
    public function actionCompanyDetail($uid = '0') {
        $uid = intval($uid);

        $query = (new \yii\db\Query())
                ->select('cu.short_name,cu.company_name,cu.logo clogo,cu.area_x,cu.area_y,cu.province,'
                        . 'cu.city,cu.district,cu.summary,cu.mobile,cu.email,cu.comment_score,cu.job,cu.contacts')
                ->from('it_company_user cu,it_user u,it_task t');
        $query->where('cu.uid=u.id');
        $query->andWhere('u.id=' . $uid);

        $data = $query->one();
        if (is_array($data) && !empty($data)) {
            $data['clogo'] = $this->image_ip . $data['clogo'];
            $data['finish'] = Task::find()->where('uid=' . $uid)->andWhere('status=2')->count();
            $data['ing'] = Task::find()->where('uid=' . $uid)->andWhere('status=1')->count();
        }
        $this->arr['data'] = $data ? $data : '';
        return $this->arr;
    }

    /**
     * 修改公司资料
     */
    public function actionUpdateCompanyInfo() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $uid = isset($post_arr['uid']) ? intval($post_arr['uid']) : '0';
        $privacy = isset($post_arr['privacy']) ? intval($post_arr['privacy']) : '0';
        $short_name = isset($post_arr['s_name']) ? $post_arr['s_name'] : '';
        $company_name = isset($post_arr['c_name']) ? $post_arr['c_name'] : '';
        $province = isset($post_arr['province']) ? $post_arr['province'] : '';
        $city = isset($post_arr['city']) ? $post_arr['city'] : '';
        $district = isset($post_arr['district']) ? $post_arr['district'] : '';
        $address = isset($post_arr['address']) ? $post_arr['address'] : '';
        $contacts = isset($post_arr['contacts']) ? $post_arr['contacts'] : '';
        $job = isset($post_arr['job']) ? $post_arr['job'] : '';
        $mobile = isset($post_arr['mobile']) ? $post_arr['mobile'] : '';
        $email = isset($post_arr['email']) ? $post_arr['email'] : '';
        $summary = isset($post_arr['summary']) ? $post_arr['summary'] : '';
        $privacy = isset($post_arr['privacy']) ? intval($post_arr['privacy']) : '0';

        if (!empty($uid)) {
            $data = CompanyUser::find()->select('id')->where('uid=' . $uid)->asArray()->one();
            if (isset($data['id']) && !empty($data['id'])) {
                $model = CompanyUser::findOne($data['id']);

                if ($model) {
                    if ($short_name) {
                        $model->short_name = $short_name;
                    }

                    if ($company_name) {
                        $model->company_name = $company_name;
                    }

                    if ($province) {
                        $model->province = $province;
                    }

                    if ($city) {
                        $model->city = $city;
                    }

                    if ($district) {
                        $model->district = $district;
                    }

                    if ($address) {
                        $model->address = $address;
                    }

                    if ($contacts) {
                        $model->contacts = $contacts;
                    }

                    if ($job) {
                        $model->job = $job;
                    }

                    if ($email) {
                        $model->email = $email;
                    }

                    if ($mobile) {
                        $model->mobile = $mobile;
                    }

                    if ($privacy) {
                        $model->privacy = $privacy;
                    }

                    if ($summary) {
                        $model->summary = $summary;
                    }


                    if (!$model->update()) {
                        $this->arr['errno'] = '0';
                    }
                }
            }
        }

        return $this->arr;
    }

    /**
     * 修改专家资料
     */
    public function actionUpdateExpertInfo() {

        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $uid = isset($post_arr['uid']) ? intval($post_arr['uid']) : '0';

        $short_name = isset($post_arr['s_name']) ? $post_arr['s_name'] : '';
        $true_name = isset($post_arr['t_name']) ? $post_arr['t_name'] : '';
        $province = isset($post_arr['province']) ? $post_arr['province'] : '';
        $city = isset($post_arr['city']) ? $post_arr['city'] : '';
        $district = isset($post_arr['district']) ? $post_arr['district'] : '';
        $address = isset($post_arr['address']) ? $post_arr['address'] : '';
        $skill = isset($post_arr['skill']) ? intval($post_arr['skill']) : '0';
        $length_service = isset($post_arr['service']) ? $post_arr['service'] : '';
        $mobile = isset($post_arr['mobile']) ? $post_arr['mobile'] : '';
        $email = isset($post_arr['email']) ? $post_arr['email'] : '';
        $summary = isset($post_arr['summary']) ? $post_arr['summary'] : '';

        if (!empty($uid)) {
            $data = ExpertUser::find()->select('id')->where('uid=' . $uid)->asArray()->one();
            if (isset($data['id']) && !empty($data['id'])) {
                $model = ExpertUser::findOne($data['id']);

                if ($model) {
                    if ($short_name) {
                        $model->short_name = $short_name;
                    }

                    if ($true_name) {
                        $model->company_name = $true_name;
                    }

                    if ($province) {
                        $model->province = $province;
                    }

                    if ($city) {
                        $model->city = $city;
                    }

                    if ($district) {
                        $model->district = $district;
                    }

                    if ($address) {
                        $model->address = $address;
                    }


                    if ($skill) {
                        $model->skill = $skill;
                    }

                    if ($email) {
                        $model->email = $email;
                    }

                    if ($mobile) {
                        $model->mobile = $mobile;
                    }

                    if ($length_service) {
                        $model->length_service = $length_service;
                    }

                    if ($summary) {
                        $model->summary = $summary;
                    }

                    if (!$model->update()) {
                        $this->arr['errno'] = '0';
                    }
                }
            }
        }

        return $this->arr;
    }

    /**
     * 专家列表
     */
    public function actionExpertList($area = '', $skill = '0', $sort = '0', $from = '0', $limit = '10') {

        $skill = intval($skill);
        $sort = intval($sort);
        $area = $area ? urldecode($area) : '';

        $query = (new \yii\db\Query())
                ->select('eu.short_name,eu.true_name,eu.logo elogo,eu.level,eu.skill,eu.area_x,eu.area_y,eu.id auto_id,u.id uid,eu.province,eu.city,eu.district,eu.comment_score')
                ->from('it_expert_user eu,it_user u');
        $query->where('eu.uid=u.id');
        if (!empty($skill)) {
            $query->andFilterWhere(array('like', 'skill', ',' . $skill . ','));
        }

        if (!empty($area) && strstr($area, ',')) {
            $area_arr = explode(',', $area);
            $query->andWhere('eu.province="' . $area_arr['0'] . '"');
            $query->andWhere('eu.city="' . $area_arr['1'] . '"');
        }

        $query1 = clone $query;
        $total = $query1->count();

        if ('1' == $sort) {//技能评分倒序
            $query->orderBy('eu.comment_score DESC');
        } elseif ('2' == $sort) {//技能评分正序
            $query->orderBy('eu.comment_score ASC');
        } elseif ('3' == $sort) {//头衔级别倒序
            $query->orderBy('eu.amount DESC');
        } elseif ('4' == $sort) {//头衔级别正序
            $query->orderBy('eu.amount ASC');
        } elseif ('5' == $sort) {//距离近到远
        } else {
            $query->orderBy('u.id DESC');
        }

        $data = $query->offset(intval($from))
                ->limit(intval($limit))
                ->all();
        if (is_array($data) && !empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k]['elogo'] = $this->image_ip . $v['elogo'];
                $data[$k]['skill'] = '';
                if (strstr($v['skill'], ',')) {
                    $skill = trim($v['skill'], ',');
                    $data[$k]['skill'] = $this->getSkillStr($skill);
                }

                if ('0' == $v['level']) {
                    $level_name = '新手上路';
                } elseif ('1' == $v['level']) {
                    $level_name = '普通专家';
                } elseif ('2' == $v['level']) {
                    $level_name = '资深专家';
                } else {
                    $level_name = '暂无等级';
                }
                $data[$k]['level_name'] = $level_name;
                //获取评论次数
                $comment_times = Task::find()->where('e_comment_time!=0')->andWhere('expert_id=' . $v['uid'])->count();
                $data[$k]['comment_level'] = $comment_times > 0 ? ($v['comment_score'] / ($comment_times * 5)) * 5 : '0';

                unset($data[$k]['comment_score']);
            }
        }
        $this->arr['data']['total'] = $total;
        $this->arr['data']['list'] = $data;
        return $this->arr;
    }

    /**
     * 专家详情
     */
    public function actionExpertDetail($uid = '0') {
        $uid = intval($uid);

        $query = (new \yii\db\Query())
                ->select('eu.short_name,eu.true_name,eu.logo elogo,eu.level,eu.skill,eu.area_x,eu.area_y,eu.province,'
                        . 'eu.city,eu.district,eu.length_service service,eu.summary,eu.mobile,eu.email')
                ->from('it_expert_user eu,it_user u');
        $query->where('eu.uid=u.id');
        $query->andWhere('u.id=' . $uid);

        $data = $query->one();
        if (is_array($data) && !empty($data)) {
            $data['elogo'] = $this->image_ip . $data['elogo'];
            $data['finish'] = Task::find()->where('expert_id=' . $uid)->andWhere('status=2')->count();
        }
        $this->arr['data'] = $data ? $data : '';
        return $this->arr;
    }

    /**
     * 更新专家的地理位置
     */
    public function actionUpdateExpertAreaxy() {
        $post_arr = Yii::$app->request->post();
        $uid = isset($post_arr['uid']) ? intval($post_arr['uid']) : '0';
        $area_x = isset($post_arr['area_x']) ? $post_arr['area_x'] : '';
        $area_y = isset($post_arr['area_y']) ? $post_arr['area_y'] : '';
        $data = ExpertUser::find()->select('id')->where('uid=' . $uid)->asArray()->one();
        if (isset($data['id']) && !empty($data['id'])) {
            $model = ExpertUser::findOne($data['id']);
            if ($model) {
                $model->area_x = $area_x;
                $model->area_y = $area_y;
                if (!$model->update()) {
                    $this->arr['errno'] = '0';
                }
            }
        }
        return $this->arr;
    }

    /**
     * 更新公司地理位置
     */
    public function actionUpdateCompanyAreaxy() {
        $post_arr = Yii::$app->request->post();
        $uid = isset($post_arr['uid']) ? intval($post_arr['uid']) : '0';
        $area_x = isset($post_arr['area_x']) ? $post_arr['area_x'] : '';
        $area_y = isset($post_arr['area_y']) ? $post_arr['area_y'] : '';
        $data = CompanyUser::find()->select('id')->where('uid=' . $uid)->asArray()->one();
        if (isset($data['id']) && !empty($data['id'])) {
            $model = CompanyUser::findOne($data['id']);
            if ($model) {
                $model->area_x = $area_x;
                $model->area_y = $area_y;
                if (!$model->update()) {
                    $this->arr['errno'] = '0';
                }
            }
        }
        return $this->arr;
    }

    /**
     * 获取专家分类数据
     */
    public function actionSkillAll($cat_id = '0') {
        $data = Skill::find()->select('id,name,parent_id')->asArray()->all();
        $data = ApiTool::tree($data);
        if (!empty($cat_id)) {
            //获取父类
            $skill_model = Skill::findOne($cat_id);
            if (is_array($data) && !empty($data)) {
                foreach ($data as $k => $v) {
                    $data[$k]['is_checked'] = '0';
                    if ($v['id'] == $skill_model->parent_id) {
                        $data[$k]['is_checked'] = '1';
                        if (isset($v['children'])) {
                            foreach ($v['children'] as $k1 => $v1) {
                                $data[$k]['children'][$k1]['is_checked'] = '0';
                                if ($v1['id'] == $cat_id) {
                                    $data[$k]['children'][$k1]['is_checked'] = '1';
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->arr['data'] = $data;
        return $this->arr;
    }

    /**
     * ------------------------------------------------工具方法---------------------------------------------------------
     */
    function getSkillStr($str = '') {
        $s = '';
        if (!empty($str)) {
            if (strstr($str, ',')) {
                $skill_arr = explode(',', $str);
                if (is_array($skill_arr) && !empty($skill_arr)) {
                    foreach ($skill_arr as $v) {
                        $model = Skill::findOne($v);
                        $s.=$model->name . ',';
                    }
                    $s = rtrim($s, ',');
                }
            } else {
                $model = Skill::findOne($str);
                $s.=$model->name;
            }
        }

        return $s;
    }

    function fileExists($uploadpath) {

        if (!file_exists($uploadpath)) {
            mkdir($uploadpath, 0777, true);
        }

        return $uploadpath;
    }

    function uploadedFile($item) {
        return yii\web\UploadedFile::getInstanceByName($item);
    }

    function uploadedFiles($item) {
        return yii\web\UploadedFile::getInstancesByName($item);
    }

}
