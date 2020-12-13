<?php

namespace Orders;

/**
 * Class Order
 * @package Orders
 */
class Order
{
    /**
     * @var bool
     */
    public $is_valid;

	/**
	 * @var int
	 */
	public $order_id;

	/**
	 * @var bool
	 */
	public $is_manual = false;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var array
	 */
	public $items;

	/**
	 * @var float
	 */
	public $totalAmount;

	/**
	 * @var string
	 */
	public $deliveryDetails;

    /**
     * @param string $name
     * @return $this
     */
	public function setName(string $name)
	{
		$this->name = $name;

        return $this;
	}

    /**
     * @param array $items
     * @return $this
     */
	public function setItems(array $items)
	{
		$this->items = $items;

        return $this;
	}

    /**
     * @param float $totalAmount
     * @return $this
     */
	public function setTotalAmount(float $totalAmount)
	{
		$this->totalAmount = $totalAmount;

        return $this;
	}

    /**
     * @param int $order_id
     * @return $this
     */
	public function setOrderId(int $order_id)
	{
		$this->order_id = $order_id;

		return $this;
	}

    /**
     * @param string $deliveryDetails
     * @return $this
     */
	public function setDeliveryDetails(string $deliveryDetails)
	{
		$this->deliveryDetails = $deliveryDetails;

        return $this;
	}
}
