<?php

/**
 * 
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;  //这是必须的步骤，因为我们要使用 ActiveDataProvider 类

class BookController extends Controller {

    function actionBookEdit() {
        return $this->renderPartial('book-edit');
    }

}
