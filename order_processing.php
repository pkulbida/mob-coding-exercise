<?php

require_once 'vendor/autoload.php';

use App\Models\Order;
use App\Processors\OrderProcessor;
use App\Detalizators\OrderDeliveryDetails;
use App\Factories\ValidatorFactory;
use App\Processors\OutputProcessor;

$order = (new Order)
    ->setOrderId(2)
    ->setName('John')
    ->setItems([ 6654 ])
    ->setTotalAmount(346.2);

(new OrderProcessor(new OrderDeliveryDetails, new ValidatorFactory, new OutputProcessor))->process($order);
