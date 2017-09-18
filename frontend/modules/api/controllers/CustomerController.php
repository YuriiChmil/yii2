<?php

namespace frontend\modules\api\controllers;

use common\amqp\CustomerJob;
use common\models\Customer;
use frontend\models\customer\CustomerForm;
use frontend\services\customer\CustomerServiceInterface;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use Yii;
use yii\base\Module;
use yii\web\Request;
use yii\web\Response;

class CustomerController extends ActiveController
{
    /**
     * @var CustomerServiceInterface
     */
    private $customerService;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Request
     */
    private $request;

    public function __construct(
        $id,
        Module $module,
        CustomerServiceInterface $customerService,
        Response $response,
        array $config = []
    ) {
        $this->customerService = $customerService;
        $this->response = $response;
        parent::__construct($id, $module, $config);
    }

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
        $form = new CustomerForm();
        $form->load(Yii::$app->request->getBodyParams(), '');
        if ($form->validate()) {
            Yii::$app->queue->push(new CustomerJob($this->customerService, $form));
           return $this->response->setStatusCode(201);
        }
        return $form;
    }
}