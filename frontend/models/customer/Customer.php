<?php

namespace frontend\models\customer;

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
                $customer->updateEsIndex();
            }
            $transaction->commit();
        } catch (\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }

    /**
     * @return bool whether ES index successfully updated
     */
    public function updateEsIndex(): bool
    {
        return $this->createEsCustomer()->save();
    }

    public function createEsCustomer(): CustomerEs
    {
        if (!$customerEs = CustomerEs::findOne($this->id)) {
            $customerEs = new CustomerEs(['id' => (int)$this->id]);
        }
        $customerEs->firstName = $this->first_name;
        $customerEs->lastName = $this->last_name;
        $phones = [];
        foreach ($this->phones as $phone) {
            $phones[] = $phone->phone;
        }
        $customerEs->phones = $phones;
        return $customerEs;
    }
}