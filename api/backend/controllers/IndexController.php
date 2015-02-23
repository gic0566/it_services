<?php

namespace backend\controllers;

use yii\web\Controller;

class IndexController extends Controller {

    function actionIndex() {
        return $this->render('index');
    }

    function actionTop() {
        return $this->renderPartial('top');
    }

    function actionLeft() {
        return $this->renderPartial('left');
    }

    function actionRight() {
        return $this->renderPartial('right');
    }

}
