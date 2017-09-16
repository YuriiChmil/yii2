<?php

namespace backend\models;

use yii\base\Model;

class UserEditForm extends Model
{
    use UserDtoTrait;
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user, array $config = [])
    {
        $this->userName = $user->username;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->user = $user;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['userName', 'email', 'status'], 'required'],
            [['userName', 'email', 'password'], 'string'],
            [
                'userName',
                'unique',
                'targetClass' => User::class,
                'targetAttribute' => 'username',
                'filter' => ['<>', 'id', $this->user->id]
            ],
            [
                'email',
                'unique',
                'targetClass' => User::class,
                'targetAttribute' => 'email',
                'filter' => ['<>', 'id', $this->user->id]
            ],
        ];
    }
}