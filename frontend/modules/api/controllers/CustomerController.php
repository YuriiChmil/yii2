<?php

namespace frontend\modules\api\controllers;

class CustomerController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        return ['test' => ['2234']];
    }
}