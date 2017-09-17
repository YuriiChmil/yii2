<?php

namespace frontend\services\customer;

use frontend\models\CustomerDtoInterface;

/**
 * Interface CustomerServiceInterface
 * @package services
 */
interface CustomerServiceInterface
{
    /**
     * @param CustomerDtoInterface $customerDto
     * @return mixed
     */
    public function addCustomer(CustomerDtoInterface $customerDto);
}