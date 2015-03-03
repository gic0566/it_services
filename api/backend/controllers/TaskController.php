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

    function actionDetail() {
        return $this->renderPartial('detail');
    }
    
    function actionList() {
        $taskArr = Task::find()->asArray()->all();
        return $this->renderPartial('list',array('taskArr'=>$taskArr));
    }

}
