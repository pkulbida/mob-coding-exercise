<?php

namespace App\Validators;

use App\Models\DomainModelInterface;

/**
 * Class OrderValidator
 * @package App\Validators
 */
class OrderValidator implements ValidatorInterface
{
    /**
     * @var bool
     */
    protected $isValid = true;

    /**
     * @var int
     */
	public $minimumAmount;

    /**
     * @param int $amount
     * @return $this
     */
	public function setMinimumAmount(int $amount)
	{
		$this->minimumAmount = $amount;

		return $this;
	}

    /**
     * @param $order DomainModelInterface
     */
    public function validate(DomainModelInterface $order)
    {
	    if (!is_string($order->getName())
            || strlen($order->getName()) <= 2
            || $order->getTotalAmount() <= 0
            || $order->getTotalAmount() < $this->minimumAmount
            || !is_array($order->getItems())
        ) {
            $this->isValid = false;
	    }

	    foreach ($order->getItems() as $itemId) {
		    if (!is_int($itemId)) {
                $this->isValid = false;
		    }
	    }

	    return $this;
    }

    /**
     * @return bool
     */
    public function fails()
    {
        return !$this->isValid;
    }
}
