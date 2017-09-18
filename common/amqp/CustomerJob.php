<?php

namespace common\amqp;

use frontend\models\customer\CustomerDtoInterface;
use frontend\services\customer\CustomerServiceInterface;
use yii\queue\Job;

class CustomerJob implements Job
{
    /**
     * @var CustomerServiceInterface
     */
    private $customerService;
    /**
     * @var CustomerDtoInterface
     */
    private $customerDto;

    /**
     * CustomerJob constructor.
     * @param CustomerServiceInterface $customerService
     * @param CustomerDtoInterface $customerDto
     */
    public function __construct(CustomerServiceInterface $customerService, CustomerDtoInterface $customerDto)
    {
        $this->customerService = $customerService;
        $this->customerDto = $customerDto;
    }

    public function execute($queue)
    {
        $this->customerService->addCustomer($this->customerDto);
    }
}