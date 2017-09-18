<?php

namespace console\controllers;

use common\models\dto\UserDto;
use common\models\User;
use frontend\models\customer\CustomerEs;
use yii\console\Controller;
use yii\helpers\Console;
use frontend\models\customer\Customer;

class InitController extends Controller
{
    public function actionCreateUser()
    {
        $name = 'admin';
        $email = 'admin@admin.com';
        $password = 'admin';
        $dto = new UserDto($name, $email, User::STATUS_ACTIVE);
        $dto->setPassword($password);
        try {
            User::create($dto)->save();
            $this->stdout(
                sprintf('User with email: %s, name: %s, password: %s was created %s',
                    $name, $email, $password, PHP_EOL
                ),
                Console::FG_GREEN
            );
        } catch (\Exception $exception) {
            $this->stderr($exception->getMessage(), Console::FG_RED, Console::UNDERLINE);
        }
    }

    public function actionIndexCustomer()
    {
        try {
            CustomerEs::createIndex();
            foreach (Customer::find()->each() as $customer) {
                $customer->updateEsIndex();
            }
        } catch (\Exception $exception) {
            throw  $exception;
            $this->stderr($exception->getMessage(), Console::FG_RED, Console::UNDERLINE);
        }
    }
}