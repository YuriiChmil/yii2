<?php

namespace frontend\models;

use common\models\Customer;
use common\models\CustomerPhone;
use yii\base\Model;

class CustomerForm extends Model implements CustomerDtoInterface
{
    /**
     * @var string
     */
    public $firstName;
    /**
     * @var
     */
    public $lastName;
    /**
     * @var string[]
     */
    public $phoneNumbers;

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'phoneNumbers'], 'required'],
            [
                ['firstName', 'lastName'],
                'unique',
                'targetClass' => Customer::class,
                'targetAttribute' => ['firstName' => 'first_name', 'lastName' => 'last_name']
            ],
            [['phoneNumbers'], 'isArray'],
            [['phoneNumbers'], 'each', 'rule' => ['string', 'message' => 'Each value must be a string']],
            [['phoneNumbers'], 'hasDuplicates'],
            [
                ['phoneNumbers'],
                'each',
                'rule' => ['unique', 'targetClass' => CustomerPhone::class, 'targetAttribute' => 'phone']
            ],
            [
                ['phoneNumbers'],
                'each',
                'rule' => [
                    'match',
                    'pattern' => '/^\d{3} \d{3}-\d{4}$/',
                    'message' => 'Value must be in next format "812 123-1234" '
                ]
            ],

        ];
    }

    public function isArray()
    {
        if (!is_array($this->phoneNumbers)) {
            $this->addError('phoneNumbers', 'Field must be an array');
        }
    }

    public function hasDuplicates()
    {
        if (count($this->phoneNumbers) !== count(array_unique($this->phoneNumbers))) {
            $this->addError('phoneNumbers', 'There are  one or more duplicate');
        }
    }

    /**
     * @inheritdoc
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @inheritdoc
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @inheritdoc
     */
    public function getPhones(): array
    {
        return $this->phoneNumbers;
    }
}