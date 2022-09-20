<?php

namespace app\controllers;
use Yii;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        print_r(Yii::$app->user->identity->username);die();
        return $this->render('index');
    }

    public function actionSex()
    {
        return $this->render('index');
    }

}
