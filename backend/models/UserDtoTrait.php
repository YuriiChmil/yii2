<?php

namespace backend\models;

use common\models\dto\UserDto;

trait UserDtoTrait
{
    /**
     * @var string
     */
    public $userName;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $status;
    /**
     * @var
     */
    public $password;

    /**
     * @return UserDto
     */
    public function getDto(): UserDto
    {
        return (new UserDto($this->userName, $this->email, $this->status))->setPassword($this->password);
    }
}