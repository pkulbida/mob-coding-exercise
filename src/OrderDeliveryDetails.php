<?php

namespace Orders;

/**
 * Class OrderDeliveryDetails
 * @package Orders
 */
class OrderDeliveryDetails
{
    const ORDER_DELIVERY_TIME_DEFAULT = 'Order delivery time: 1 day';
    const ORDER_DELIVERY_TIME_CUSTOM = 'Order delivery time: 1 day';

    /**
     * @param int $productsCount
     * @return string
     */
	public static function getDeliveryDetails(int $productsCount): string
	{
	    return $productsCount > 1
            ? self::ORDER_DELIVERY_TIME_CUSTOM
            : self::ORDER_DELIVERY_TIME_DEFAULT;
	}
}
