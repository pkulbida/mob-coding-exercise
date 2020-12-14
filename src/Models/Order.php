<?php

namespace App\Models;

/**
 * Class Order
 * @package App\Models
 */
class Order implements DomainModelInterface
{
	/**
	 * @var int
	 */
	public $orderId;

	/**
	 * @var bool
	 */
	public $isManual = false;

    /**
     * @var bool
     */
    public $isValid = false;

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
     * @param int $orderId
     * @return $this
     */
    public function setOrderId(int $orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @param bool $isManual
     * @return $this
     */
    public function setIsManual(bool $isManual)
    {
        $this->isManual = $isManual;

        return $this;
    }

    /**
     * @param bool $isValid
     * @return $this
     */
    public function setIsValid(bool $isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

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
     * @param string $deliveryDetails
     * @return $this
     */
	public function setDeliveryDetails(string $deliveryDetails)
	{
		$this->deliveryDetails = $deliveryDetails;

        return $this;
	}

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function isManual(): int
    {
        return $this->isManual ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @return string
     */
    public function getDeliveryDetails(): string
    {
        return $this->deliveryDetails;
    }
}
