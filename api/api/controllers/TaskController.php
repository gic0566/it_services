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
use \common\models\ApiTool;

class TaskController extends ActiveController {

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
     * 需求列表
     * @return type
     */
    public function actionList($uid = '', $status = '9', $sort = '', $from = '0', $limit = '10') {
        $from = intval($from);
        $limit = intval($limit);
        $uid = intval($uid); //公司id
        $status = intval($status);
        $sort = intval($sort);
        $query = (new \yii\db\Query())
                ->select('t.category cat_id,cu.company_name cname,t.add_time,t.id task_id,t.title,t.status,t.uid,t.expert_id,cu.logo clogo,t.c_comment_level clevle,cu.area_x carea_x,cu.area_y carea_y')
                ->from('it_task t,it_company_user cu');

        $query->where('t.uid=cu.uid');

        if (!empty($uid)) {//公司id
            $query->andWhere('t.uid=' . $uid);
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

        $data = $query->offset($from)
                ->limit($limit)
                ->all();

        if (!empty($data)) {
            foreach ($data AS $k => $v) {
                //获取申请需求申请人数
                $data[$k]['apply_num'] = TaskUser::find()->where('task_id=' . $v['task_id'])->count();
                $data[$k]['clogo'] = $this->image_ip . $v['clogo'];
                $data[$k]['add_time'] = date('Y-m-d', $v['add_time']);
                if ($v['status'] != '0' && !empty($v['expert_id'])) {
                    $expert_arr = ExpertUser::findOne($v['expert_id']);
                    $data[$k]['clogo'] = $this->image_ip . $expert_arr['logo'];
                    $data[$k]['cname'] = $expert_arr['true_name'];
                }
            }
            $this->arr['data']['total'] = $total;
            $this->arr['data']['list'] = $data;
        }
        return $this->arr;
    }

    /**
     * 发布新需求
     */
    public function actionPublishNew() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr); 
        $title = isset($post_arr['title']) ? $post_arr['title'] : '';
        $content = isset($post_arr['content']) ? $post_arr['content'] : '';
        $category = isset($post_arr['category']) ? intval($post_arr['category']) : '0';
        $uid = isset($post_arr['uid']) ? intval($post_arr['uid']) : '0';
        $tips = isset($post_arr['tips']) ? $post_arr['tips'] : '';
        $reward = isset($post_arr['reward']) ? $post_arr['reward'] : ''; //悬赏
        $valid_end_time = isset($post_arr['valid_time']) ? $post_arr['valid_time'] : ''; //有效期截止
        if (!empty($uid) && !empty($title) && !empty($content) && !empty($category) && !empty($reward) && !empty($valid_end_time)) {
            $model = new Task();
            if ($model) {
                $model->uid = $uid;
                $model->title = $title;
                $model->content = $content;
                $model->category = $category;
                $model->tips = $tips;
                $model->add_time = time();
                $model->reward = $reward;
                $model->valid_end_time = strtotime($valid_end_time);
                if (!$model->insert()) {
                    $this->arr['errno'] = '0';
                }
            }
        } else {
            $this->arr['errno'] = '0';
        }
        return $this->arr;
    }

    /**
     * 修改需求
     */
    public function actionModify() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $id = isset($post_arr['id']) ? intval($post_arr['id']) : '';
        $title = isset($post_arr['title']) ? $post_arr['title'] : '';
        $content = isset($post_arr['content']) ? $post_arr['content'] : '';
        $category = isset($post_arr['category']) ? intval($post_arr['category']) : '';
        $tips = isset($post_arr['tips']) ? $post_arr['tips'] : '';
        $reward = isset($post_arr['reward']) ? $post_arr['reward'] : ''; //悬赏
        $valid_end_time = isset($post_arr['valid_time']) ? $post_arr['valid_time'] : ''; //有效期截止

        if (!empty($id) && !empty($title) && !empty($content) && !empty($category) && !empty($tips) && !empty($reward) && !empty($valid_end_time)) {
            $model = Task::findOne($id);
            if ($model) {
                $model->title = $title;
                $model->content = $content;
                $model->category = $category;
                $model->tips = $tips;
                $model->reward = $reward;
                $model->valid_end_time = strtotime($valid_end_time);
                if ($model->update()) {
                    $this->arr['errno'] = '0';
                }
            }
        } else {
            $this->arr['errno'] = '0';
        }
        return $this->arr;
    }

    /**
     * 需求详情
     */
    public function actionDetail($id = '0', $uid = '0') {
        $id = intval($id);
        $uid = intval($uid);
        $query = (new \yii\db\Query())
                ->select('t.title,t.content,t.tips,t.reward,t.c_comment_level clevel,cu.mobile,cu.email,t.valid_end_time,t.category,cu.logo clogo,cu.province,cu.city,cu.district,t.id task_id')
                ->from('it_task t,it_company_user cu');

        $query->where('t.uid=cu.uid');

        $query->andWhere('t.id=' . $id);

        $data = $query->one();
        if (!empty($data)) {
            //判断用户是否申请过
            $data['is_apply'] = TaskUser::find()->where('task_id=' . $data['task_id'])->andWhere('proposer_id=' . $uid)->count();
            $data['valid_end_time'] = date('Y-m-d', $data['valid_end_time']);
            $data['category'] = $this->expertSkill($data['category']);
            $this->arr['data'] = $data;
        }

        return $this->arr;
    }

    /**
     * 公司接受专家申请
     */
    public function actionCompanyAcceptExpert() {
        $post_arr = Yii::$app->request->post();
        $id = isset($post_arr['task_id']) ? intval($post_arr['task_id']) : ''; //项目id
        $expert_id = isset($post_arr['expert_id']) ? intval($post_arr['expert_id']) : ''; //专家id
        $model = Task::findOne($id);
        if ($model) {
            $model->expert_id = $expert_id;
            $model->begin_time = time();
            $model->status = '1';
            if (!$model->update()) {
                $this->arr['errno'] = '0';
            }
        }

        return $this->arr;
    }

    /**
     * 更新项目状态
     */
    public function actionUpdateStatus() {
        $post_arr = Yii::$app->request->post();
        $id = isset($post_arr['task_id']) ? intval($post_arr['task_id']) : ''; //项目id
        $status = isset($post_arr['status']) ? intval($post_arr['status']) : ''; //状态
        if (!empty($id)) {
            $model = Task::findOne($id);
            if ($model) {
                if ('3' == $status) {
                    $model->finish_time = time();
                }
                $model->status = $status;
                if (!$model->update()) {
                    $this->arr['errno'] = '0';
                } else {
                    //更新已完成的项目数
                    $user_extend_arr = ExpertUser::find()->select('id')->where('uid=' . $model->expert_id)->asArray()->one();
                    if (!empty($user_extend_arr)) {
                        $expert_model = ExpertUser::findOne($user_extend_arr['id']);
                        if ($expert_model) {
                            $expert_model->task_num++;
                            if (!$expert_model->update()) {
                                $this->arr['errno'] = '0';
                            }
                        }
                    }
                }
            }
        }

        return $this->arr;
    }

    /**
     * 公司评价专家
     */
    public function actionCompanyToExpertComment() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $id = isset($post_arr['task_id']) ? intval($post_arr['task_id']) : ''; //项目id
        $comment_level = isset($post_arr['level']) ? intval($post_arr['level']) : ''; //评价等级
        $comment = isset($post_arr['comment']) ? $post_arr['comment'] : ''; //评价内容

        if (!empty($id)) {
            $model = Task::findOne($id);
            if ($model) {
                $model->e_comment_time = time();
                $model->e_comment = $comment;
                $model->e_comment_level = $comment_level;
                if (!$model->update()) {
                    $this->arr['errno'] = '0';
                } else {
                    //更新专家总评分
                    $user_extend_arr = ExpertUser::find()->select('id')->where('uid=' . $model->expert_id)->asArray()->one();
                    if (!empty($user_extend_arr)) {
                        $expert_model = ExpertUser::findOne($user_extend_arr['id']);
                        $expert_model->comment_score+=$comment_level;
                        if (!$expert_model->update()) {
                            $this->arr['errno'] = '0';
                        }
                    }
                }
            }
        }
        return $this->arr;
    }

    /**
     * 专家评价公司
     */
    public function actionExpertToCompanyComment() {
        $post_arr = Yii::$app->request->post();
        $post_arr = ApiTool::post_format($post_arr);
        $id = isset($post_arr['task_id']) ? intval($post_arr['task_id']) : ''; //项目id
        $comment_level = isset($post_arr['level']) ? intval($post_arr['level']) : ''; //评价等级
        $comment = isset($post_arr['comment']) ? $post_arr['comment'] : ''; //评价内容
        if (!empty($id)) {
            $model = Task::findOne($id);
            if ($model) {
                $model->c_comment_time = time();
                $model->c_comment = $comment;
                $model->c_comment_level = $comment_level;
                if (!$model->update()) {
                    $this->arr['errno'] = '0';
                } else {
                    //更新公司总评分
                    $user_company_arr = CompanyUser::find()->select('id')->where('uid=' . $model->uid)->asArray()->one();
                    if (!empty($user_company_arr)) {
                        $expert_model = CompanyUser::findOne($user_company_arr['id']);
                        $expert_model->comment_score+=$comment_level;
                        if (!$expert_model->update()) {
                            $this->arr['errno'] = '0';
                        }
                    }
                }
            }
        }

        return $this->arr;
    }

    /**
     * 专家提交申请
     */
    public function actionExpertApply() {
        $post_arr = Yii::$app->request->post();
        $task_id = isset($post_arr['task_id']) ? intval($post_arr['task_id']) : ''; //项目id
        $expert_id = isset($post_arr['expert_id']) ? intval($post_arr['expert_id']) : ''; //专家id
        if (!empty($task_id) && !empty($expert_id)) {
            $model = new TaskUser();
            if ($model) {
                $model->proposer_id = $expert_id;
                $model->task_id = $task_id;
                $model->add_time = time();
                if (!$model->insert()) {
                    $this->arr['errno'] = '0';
                }
            }
        }
        return $this->arr;
    }

    /**
     * 申请专家列表
     */
    public function actionApplyExpertList($task_id = '0', $from = '0', $limit = '10') {
        $task_id = intval($task_id);

        $query = (new \yii\db\Query())
                ->select('eu.uid,eu.id auto_id,eu.short_name,eu.true_name,eu.logo elogo,eu.province,eu.city,eu.district,eu.skill,eu.level,eu.area_x,eu.area_y')
                ->from('it_task_user tu,it_expert_user eu');

        $query->where('tu.proposer_id=eu.uid');

        $query->andWhere('tu.task_id=' . $task_id);

        $query1 = clone $query;
        $total = $query1->count();

        $data = $query->offset($from)
                ->limit($limit)
                ->all();

        if (!empty($data)) {
            foreach ($data AS $k => $v) {
                $data[$k]['elogo'] = $this->image_ip . $v['elogo'];
                $data[$k]['skill'] = $this->expertSkill($v['skill']);
            }
            $this->arr['data'] = $data;
            $this->arr['total'] = $total;
        }

        return $this->arr;
    }

    /**
     * 获取专长
     */
    public function actionExpertSkill($pid = '0') {
        $pid = intval($pid);
        $data = Skill::find()->select('id,name')->where('parent_id=' . $pid)->all();
        $this->arr['data'] = $data;
        return $this->arr;
    }

    /**
     * ------------------------------------------------工具方法---------------------------------------------------------
     */

    /**
     * 获取专家擅长
     */
    function expertSkill($id = '0') {
        $skill_data = Skill::find()->select('id,name,parent_id')->asArray()->all();

        $data = ApiTool::tree($skill_data, $id);
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
