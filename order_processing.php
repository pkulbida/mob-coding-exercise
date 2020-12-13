<?php

require_once 'vendor/autoload.php';

use Orders\{
    Order, OrderDeliveryDetails, OrderProcessor
};

$order = (new Order)
    ->setOrderId(2)
    ->setName('John')
    ->setItems([ 6654 ])
    ->setTotalAmount(346.2);

(new OrderProcessor(new OrderDeliveryDetails))->process($order);
