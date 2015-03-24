<?php

/**
 * 
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use backend\models\Task;
use yii\data\ActiveDataProvider;  //这是必须的步骤，因为我们要使用 ActiveDataProvider 类

class UserController extends Controller {

    public $enableCsrfValidation = false;
    var $image_ip = 'http://121.40.33.243:8888/';

    public function actionCompanyList() {
        
        if(!isset($_SESSION['it_service_admin'])){
            header('location:/index.php?r=user/login');exit;
        }
        
        $query = (new \yii\db\Query())
                ->select('u.id,u.name,cu.short_name,cu.company_name,cu.province,cu.city,cu.district,cu.address,cu.add_time,cu.contacts,cu.job,cu.mobile,cu.email,cu.logo,cu.amount,cu.summary')
                ->from('it_company_user cu,it_user u');
        $query->where('u.id=cu.uid');

        $query->andWhere('u.role=1');

        $query1 = clone $query;
        $total = $query1->count();

        $query->orderBy('u.id DESC');

        $pages = new Pagination(['totalCount' => $total, 'pageSize' => '10']);

        $companyArr = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        if (is_array($companyArr) && !empty($companyArr)) {
            foreach ($companyArr as $k => $v) {
                $companyArr[$k]['logo'] = $this->image_ip . $v['logo'];
            }
        }

        return $this->renderPartial('company-list', array('companyArr' => $companyArr,
                    'image_ip' => $this->image_ip,
                    'pages' => $pages));
    }

    public function actionExpertList() {
        
        if(!isset($_SESSION['it_service_admin'])){
            header('location:/index.php?r=user/login');exit;
        }

        $query = (new \yii\db\Query())
                ->select('u.id,u.name,eu.true_name,eu.mobile,eu.add_time,eu.logo')
                ->from('it_expert_user eu,it_user u');
        $query->where('eu.uid=u.id');

        $query->andWhere('u.role=2');

        $query->orderBy('u.id DESC');

        $query1 = clone $query;
        $total = $query1->count();

        $pages = new Pagination(['totalCount' => $total, 'pageSize' => '10']);

        $expertArr = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();


        if (is_array($expertArr) && !empty($expertArr)) {
            foreach ($expertArr as $k => $v) {
                $expertArr[$k]['logo'] = $this->image_ip . $v['logo'];
            }
        }
        return $this->renderPartial('expert-list', array('expertArr' => $expertArr,
                    'image_ip' => $this->image_ip,
                    'pages' => $pages));
    }

    public function actionCompanyDetail($id = '0') {
        
        if(!isset($_SESSION['it_service_admin'])){
            header('location:/index.php?r=user/login');exit;
        }

        $query = (new \yii\db\Query())
                ->select('u.id,u.name,cu.short_name,cu.company_name,cu.logo,cu.area_x,cu.area_y,cu.province,'
                        . 'cu.city,cu.district,cu.summary,cu.mobile,cu.email,cu.comment_score,cu.job,cu.contacts,cu.address,cu.amount,cu.add_time')
                ->from('it_company_user cu,it_user u,it_task t');
        $query->where('cu.uid=u.id');
        $query->andWhere('u.id=' . $id);

        $data = $query->one();
        if (is_array($data) && !empty($data)) {
            $data['logo'] = $this->image_ip . $data['logo'];
            $data['finish'] = Task::find()->where('uid=' . $id)->andWhere('status=2')->count();
            $data['ing'] = Task::find()->where('uid=' . $id)->andWhere('status=1')->count();
        }
        return $this->renderPartial('company-detail', array('data' => $data, 'image_ip' => $this->image_ip));
    }

    public function actionExpertDetail($id = '0') {
        
        if(!isset($_SESSION['it_service_admin'])){
            header('location:/index.php?r=user/login');exit;
        }

        $query = (new \yii\db\Query())
                ->select('u.id,u.name,eu.short_name,eu.true_name,eu.logo,eu.level,eu.skill,eu.area_x,eu.area_y,eu.province,'
                        . 'eu.city,eu.district,eu.length_service,eu.summary,eu.mobile,eu.email,eu.address,eu.add_time,eu.amount')
                ->from('it_expert_user eu,it_user u');
        $query->where('eu.uid=u.id');
        $query->andWhere('u.id=' . $id);

        $data = $query->one();
        if (is_array($data) && !empty($data)) {
            if ('0' == $data['level']) {
                $level_name = '新手上路';
            } elseif ('1' == $data['level']) {
                $level_name = '普通专家';
            } elseif ('2' == $data['level']) {
                $level_name = '资深专家';
            } else {
                $level_name = '暂无等级';
            }
            $data['level_name'] = $level_name;
            $data['distance'] = '宣武区 < 10km';

            if (!empty($data['skill'])) {
                
            }

            $data['skill_name'] = '操作系统 win8';

            $data['logo'] = $this->image_ip . $data['logo'];
            $data['finish'] = Task::find()->where('expert_id=' . $id)->andWhere('status=2')->count();
        }


        return $this->renderPartial('expert-detail', array('data' => $data, 'image_ip' => $this->image_ip));
    }

    public function actionLogin() {
        
        if ($_POST) {
            $post_arr = Yii::$app->request->post();
            if($post_arr['name']=='admin'&&$post_arr['password']=='123456'){
                $_SESSION['it_service_admin'] = '1';
                header('location:/index.php?r=task/list');exit;
            }else{
                header('location:/index.php?r=user/login');exit;
            }
        }
        return $this->renderPartial('login');
    }
    
    
    public function actionLogout(){
        unset($_SESSION['it_service_admin']);
        header('location:/index.php?r=user/login');exit;
    }

}
