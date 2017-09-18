<?php

namespace frontend\services\customer;

use frontend\models\customer\Customer;
use frontend\models\customer\CustomerDtoInterface;
use Psr\Log\LoggerInterface;

class CustomerService implements CustomerServiceInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * CustomerService constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param CustomerDtoInterface $customerDto
     */
    public function addCustomer(CustomerDtoInterface $customerDto)
    {
        try {
            Customer::createCustomer($customerDto);
            $this->logger->info(sprintf(
                    'Customer with first name: %s nas seacond name: %s was created',
                    $customerDto->getFirstName(), $customerDto->getLastName())
            );
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }
}