<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_phone}}".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $phone
 */
class CustomerPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_phone}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id'], 'integer'],
            [['phone'], 'required'],
            [['phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'phone' => 'Phone',
        ];
    }
}
