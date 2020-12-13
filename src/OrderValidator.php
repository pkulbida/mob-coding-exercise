<?php

namespace Orders;


class OrderValidator
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
     * @return OrderValidator
     */
    public static function create()
    {
    	return (new self)->setMinimumAmount(file_get_contents('input/minimumAmount'));
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
