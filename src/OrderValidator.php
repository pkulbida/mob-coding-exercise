<?php

namespace Orders;

use Orders\Interfaces\ValidatorInterface;

/**
 * Class OrderValidator
 * @package Orders
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
     * @param $order Order
     */
    public function validate(Order $order)
    {
	    if (!is_string($order->name)
            || !(strlen($order->name) > 2)
            || !($order->totalAmount > 0)
            || $order->totalAmount < $this->minimumAmount
        ) {
            $this->isValid = false;
	    }

	    foreach ($order->items as $itemId) {
		    if (!is_int($itemId)) {
                $this->isValid = false;
		    }
	    }

	    $order->setIsValid($this->isValid);
    }
}
