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

class TaskController extends Controller {

    var $image_ip = 'http://121.40.33.243:8888/';

    function actionDetail() {
        return $this->renderPartial('detail');
    }

    function actionList($status = '9', $sort = '', $from = '0', $limit = '10') {

        $query = (new \yii\db\Query())
                ->select('t.title,t.category cat_id,cu.company_name cname,t.add_time,t.id task_id,t.title,t.status,t.uid,t.expert_id,cu.logo clogo,t.c_comment_level clevle,cu.area_x carea_x,cu.area_y carea_y')
                ->from('it_task t,it_company_user cu');

        $query->where('t.uid=cu.uid');


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

        return $this->renderPartial('list', array('taskArr' => $taskArr,
                    'image_ip' => $this->image_ip,
                    'pages' => $pages));
    }

}
