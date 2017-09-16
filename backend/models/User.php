<?php

namespace backend\models;

use common\models\dto\UserDto;
use yii\helpers\ArrayHelper;

class User extends \common\models\User
{
    /**
     * @return null|string
     */
    public function getStatusLabel(): string
    {
        return ArrayHelper::getValue(self::statusList(), $this->status);
    }

    /**
     * @param UserDto $dto
     * @return User
     */
    public function edit(UserDto $dto):self
    {
        $this->username = $dto->getUserName();
        $this->email = $dto->getEmail();
        $this->status = $dto->getStatus();
        if ($dto->getPassword()) {
            $this->setPassword($dto->getPassword());
        }
        return $this;
    }
}