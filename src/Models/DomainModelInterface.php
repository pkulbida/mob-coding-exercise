<?php

namespace App\Models;

/**
 * Interface DomainModelInterface
 * @package App\Models
 */
interface DomainModelInterface
{
    /**
     * @param int $orderId
     * @return $this
     */
    public function setOrderId(int $orderId);

    /**
     * @param bool $isManual
     * @return $this
     */
    public function setIsManual(bool $isManual);

    /**
     * @param bool $isValid
     * @return $this
     */
    public function setIsValid(bool $isValid);

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items);

    /**
     * @param float $totalAmount
     * @return $this
     */
    public function setTotalAmount(float $totalAmount);

    /**
     * @param string $deliveryDetails
     * @return $this
     */
    public function setDeliveryDetails(string $deliveryDetails);

    /**
     * @return int
     */
    public function getOrderId(): int;

    /**
     * @return int
     */
    public function isManual(): int;

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getItems(): array;

    /**
     * @return float
     */
    public function getTotalAmount(): float;

    /**
     * @return string
     */
    public function getDeliveryDetails(): string;
}
