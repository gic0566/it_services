<?php

/**
 * 
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;  //这是必须的步骤，因为我们要使用 ActiveDataProvider 类
use backend\models\Task;
use backend\models\Skill;

class TaskController extends Controller {

    var $image_ip = 'http://121.40.33.243:8888/';
    

    function actionDetail($id = '0') {
        
        if(!isset($_SESSION['it_service_admin'])){
            header('location:/index.php?r=user/login');exit;
        }
        
        $id = intval($id);
        $query = (new \yii\db\Query())
                ->select('cu.company_name,t.e_comment_time,t.e_comment,t.e_comment_level,t.begin_time,t.finish_time,t.add_time,t.title,t.content,t.tips,t.reward,t.c_comment_level clevel,t.c_comment,cu.mobile,cu.email,t.valid_end_time,t.category,cu.logo clogo,cu.province,cu.city,cu.district,t.id task_id,t.status,t.c_comment_time,t.expert_id')
                ->from('it_task t,it_company_user cu');

        $query->where('t.uid=cu.uid');

        $query->andWhere('t.id=' . $id);

        $data = $query->one();
        if (!empty($data)) {
            $data['cat_name'] = '测试分类';
            $data['clogo'] = $this->image_ip . $data['clogo'];
            $data['valid_end_time'] = date('Y-m-d', $data['valid_end_time']);
        }

        return $this->renderPartial('detail', array('data' => $data, 'image_ip' => $this->image_ip));
    }

    function actionList($status = '9', $sort = '',$expert_id='0',$company_id='0', $from = '0', $limit = '10') {
        
        if(!isset($_SESSION['it_service_admin'])){
            header('location:/index.php?r=user/login');exit;
        }

        $query = (new \yii\db\Query())
                ->select('t.title,t.category cat_id,cu.company_name cname,t.add_time,t.id task_id,t.title,t.status,t.uid,t.expert_id,cu.logo clogo,t.c_comment_level clevle,cu.area_x carea_x,cu.area_y carea_y,t.reward')
                ->from('it_task t,it_company_user cu');

        $query->where('t.uid=cu.uid');
        
        if (!empty($expert_id)) {
            $expert_id = intval($expert_id);
            $query->andWhere('t.expert_id='.$expert_id);
        }

        if (!empty($company_id)) {
            $company_id = intval($company_id);
            $query->andWhere('t.uid='.$company_id);
        }

        if (!empty($status)) {
            if ($status != '9') {
                $query->andWhere('t.status=' . $status);
            }
        } else {
            $query->andWhere('t.status=0');
        }

        $query1 = clone $query;
        $total = $query1->count();

        if ('1' == $sort) {
            $query->orderBy('t.reward DESC');
        } else {
            $query->orderBy('t.add_time DESC');
        }

        $pages = new Pagination(['totalCount' => $total, 'pageSize' => '10']);

        $taskArr = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        if (is_array($taskArr) && !empty($taskArr)) {
            $status_arr = array(
                '0' => '已发布',
                '1' => '进行中',
                '2' => '已完成'
            );
            foreach ($taskArr as $k => $v) {
                $taskArr[$k]['status_name'] = $status_arr[$v['status']];
            }
        }

        return $this->renderPartial('list', array('taskArr' => $taskArr,
                    'image_ip' => $this->image_ip,
                    'pages' => $pages));
    }

    function actionDelete($id) {
        $model = Task::findOne($id);
        if ($model) {
            $model->delete();
            return $this->redirect(['task/list']);
        }
    }

    public function actionCategoryList($parent_id = '0') {
        
        if(!isset($_SESSION['it_service_admin'])){
            header('location:/index.php?r=user/login');exit;
        }
        
        $query = Skill::find();
        $query->where('parent_id=' . intval($parent_id));
        $query1 = clone $query;
        $total = $query1->count();
        $pages = new Pagination(['totalCount' => $total, 'pageSize' => '10']);
        $data = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->renderPartial('category-list', array('data' => $data,
                    'pages' => $pages));
    }

    public function actionCategoryAdd() {

        $model = new Skill();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                return $this->redirect(['task/category-list']);
            }
        }
        $data = Skill::find()->where('parent_id=0')->all();
        if (is_array($data)) {
            $datan['0'] = '全部';
            foreach ($data as $v) {
                $datan[$v['id']] = $v['name'];
            }
        }

        return $this->renderPartial('category-add', ['model' => $model, 'data' => $datan]);
    }

    public function actionCategoryEdit($id = '0') {
        $model = Skill::findOne($id);
        $data = Skill::find()->where('parent_id=0')->all();
        if (is_array($data)) {
            $datan['0'] = '全部';
            foreach ($data as $v) {
                $datan[$v['id']] = $v['name'];
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->update()) {
                return $this->redirect(['task/category-list']);
            }
        }

        return $this->renderPartial('category-edit', ['model' => $model,'data'=>$datan]);
    }

}
