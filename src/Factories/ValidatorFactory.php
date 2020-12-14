<?php

namespace App\Factories;

use App\Validators\OrderValidator;
use App\Validators\ValidatorInterface;

/**
 * Class ValidatorFactory
 * @package App\Factories
 */
class ValidatorFactory
{
    /**
     * @param null $type
     * @return ValidatorInterface
     */
    public function getValidator($type = null): ValidatorInterface
    {
        switch ($type) {
            default:
                return (new OrderValidator)->setMinimumAmount(file_get_contents('input/minimumAmount'));
        }
    }
}
