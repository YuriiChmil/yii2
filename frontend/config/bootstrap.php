<?php
$container = \Yii::$container;
$container->set(
    \frontend\services\customer\CustomerServiceInterface::class,
    \frontend\services\customer\CustomerService::class
);
$container->set(\Psr\Log\LoggerInterface::class, \Psr\Log\NullLogger::class);