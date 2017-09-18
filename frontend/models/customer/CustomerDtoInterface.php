<?php

namespace frontend\models\customer;

interface CustomerDtoInterface
{
    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return array
     */
    public function getPhones(): array;
}