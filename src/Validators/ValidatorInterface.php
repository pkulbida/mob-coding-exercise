<?php

namespace App\Validators;

use App\Models\DomainModelInterface;

/**
 * Interface ValidatorInterface
 * @package App\Validators
 */
interface ValidatorInterface
{
    /**
     * @param int $amount
     * @return $this
     */
    public function setMinimumAmount(int $amount);

    /**
     * @param $order DomainModelInterface
     */
    public function validate(DomainModelInterface $order);

    /**
     * @return bool
     */
    public function fails();
}
