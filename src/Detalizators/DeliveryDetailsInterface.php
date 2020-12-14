<?php

namespace App\Detalizators;

/**
 * Interface DeliveryDetailsInterface
 * @package App\Detalizators
 */
interface DeliveryDetailsInterface
{
    const ORDER_DELIVERY_TIME_DEFAULT = 'Order delivery time: 1 day';
    const ORDER_DELIVERY_TIME_CUSTOM  = 'Order delivery time: 1 day';

    /**
     * @param int $productsCount
     * @return string
     */
    public static function getDeliveryDetails(int $productsCount): string;
}
