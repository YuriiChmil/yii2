<?php

namespace frontend\modules\api\controllers;

use common\models\Customer;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

class CustomerController extends ActiveController
{
    public $modelClass = Customer::class;

    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
                'collectionOptions' => ['POST'],
                'resourceOptions' => [],
            ],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actionCreate()
    {

    }
}