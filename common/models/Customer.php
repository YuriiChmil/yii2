<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'required'],
            [['firstName', 'lastName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
        ];
    }
}
