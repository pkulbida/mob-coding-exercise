<?php

namespace Orders;


class OrderValidator
{
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
	    $is_valid = true;

	    if (!is_string($order->name)
            || !(strlen($order->name) > 2)
            || !($order->totalAmount > 0)
            || $order->totalAmount < $this->minimumAmount
        ) {
		    $is_valid = false;
	    }

	    foreach ($order->items as $item_id) {
		    if (!is_int($item_id)) {
			    $is_valid = false;
		    }
	    }

	    $order->is_valid = $is_valid;
    }
}
