<?php

namespace Orders;

use Orders\Interfaces\DeliveryDetailsInterface;

/**
 * Class OrderDeliveryDetails
 * @package Orders
 */
class OrderDeliveryDetails implements DeliveryDetailsInterface
{
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
