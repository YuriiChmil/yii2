<?php

namespace frontend\models;

use common\models\CustomerPhone;

class Customer extends \common\models\Customer
{
    public static function createCustomer(CustomerDtoInterface $customerDto)
    {
        $customer = new self([
            'first_name' => $customerDto->getFirstName(),
            'last_name' => $customerDto->getLastName(),
        ]);
        $transaction = self::getDb()->beginTransaction();
        try {
            $customer->save();
            foreach ($customerDto->getPhones() as $phone) {
                (new CustomerPhone([
                    'customer_id' => $customer->id,
                    'phone' => $phone,
                ]))->save();
            }
            $transaction->commit();
        } catch (\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }
}