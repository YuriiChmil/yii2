<?php

namespace common\models\dto;

class UserDto
{
    /**
     * @var string
     */
    private $userName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $status;
    /**
     * @var
     */
    private $password;

    /**
     * UserDto constructor.
     * @param string $userName
     * @param string $email
     * @param string $status
     */
    public function __construct(string $userName, string $email, string $status)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->status = $status;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}