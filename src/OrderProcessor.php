<?php

namespace Orders;

use Orders\Factories\ValidatorFactory;
use Orders\Interfaces\DeliveryDetailsInterface;

/**
 * Class OrderProcessor
 * @package Orders
 */
class OrderProcessor
{
	/**
	 * @var DeliveryDetailsInterface
	 */
	private $deliveryDetails;

    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    /**
     * OrderProcessor constructor.
     * @param DeliveryDetailsInterface $deliveryDetails
     * @param ValidatorFactory $validatorFactory
     */
	public function __construct(DeliveryDetailsInterface $deliveryDetails, ValidatorFactory $validatorFactory)
	{
		$this->deliveryDetails  = $deliveryDetails;
		$this->validatorFactory = $validatorFactory;
	}

	/**
	 * @param $order Order
	 */
	public function process(Order $order)
	{
		ob_start();
		echo "Processing started, OrderId: {$order->orderId}\n";

		$this->validatorFactory->getValidator()->validate($order);

		if ($order->isValid) {
			echo "Order is valid\n";

			$this->addDeliveryCostLargeItem($order);

			if ($order->isManual) {
				echo "Order \"" . $order->orderId . "\" NEEDS MANUAL PROCESSING\n";
			} else {
				echo "Order \"" . $order->orderId . "\" WILL BE PROCESSED AUTOMATICALLY\n";
			}

			$order->setDeliveryDetails($this->deliveryDetails->getDeliveryDetails(count($order->items)));

		} else {
			echo "Order is invalid\n";
		}

		$this->printToFile($order);
	}

	/**
	 * @param $order Order
	 */
	public function addDeliveryCostLargeItem(Order $order)
	{
		foreach ($order->items as $item) {
			if (in_array($item, [3231, 9823])) {
				$order->totalAmount += 100;
			}
		}
	}

    /**
     * @param Order $order
     */
	public function printToFile(Order $order)
	{
		$result = ob_get_contents();

		ob_end_clean();

		echo $result;

		if ($order->isValid) {
			$lines = explode("\n", $result);

			$lineWithoutDebugInfo = [];
			foreach ($lines as $line) {
				if (strpos($line, 'Reason:') === false) {
					$lineWithoutDebugInfo[] = $line;
				}
			}
		}

		file_put_contents('orderProcessLog', @file_get_contents('orderProcessLog')
            . implode("\n", $lineWithoutDebugInfo ?? [$result] )
        );

		if ($order->isValid) {
			file_put_contents('result', @file_get_contents('result')
                . $order->orderId
                . '-' . implode(',', $order->items)
                . '-' . $order->deliveryDetails
                . '-' . ($order->isManual ? 1 : 0)
                . '-' . $order->totalAmount
                . '-' . $order->name . "\n"
            );
		}
	}
}
