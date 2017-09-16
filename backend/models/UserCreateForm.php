<?php

namespace backend\models;

use yii\base\Model;

class UserCreateForm extends Model
{
    use UserDtoTrait;

    /**
     *
     * /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['userName', 'email', 'status', 'password'], 'required'],
            [['userName', 'email', 'password'], 'string'],
            ['email', 'email'],
            ['userName', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username',],
            ['email', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email',],
        ];
    }
}