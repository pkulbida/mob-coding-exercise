<?php

namespace App\Processors;

use App\Models\DomainModelInterface;

/**
 * Class OrderProcessor
 * @package App\Processors
 */
class OrderProcessor extends AbstractOrderProcessor
{
    const PROC_AMOUNT_MAGNIFIER = 100;
    const PROC_CHECKING_ITEMS   = [3231, 9823];

	/**
	 * @param $order DomainModelInterface
	 */
	public function validateProcessOrder(DomainModelInterface $order)
	{
		if (!$this->validatorFactory->getValidator()->validate($order)->fails()) {
		    $this->outputProcessor->printMessage(self::PROC_VALID_ORDER_MESSAGE);

            $order->setIsValid(true);
			$this->addDeliveryCostLargeItem($order);

            $this->outputProcessor->printMessage($order->isManual
                ? sprintf(self::PROC_MANUAL_ORDER_MESSAGE, $order->getOrderId())
                : sprintf(self::PROC_AUTO_ORDER_MESSAGE, $order->getOrderId())
            );

			$order->setDeliveryDetails($this->deliveryDetails->getDeliveryDetails(count($order->items)));
		} else {
            $this->outputProcessor->printMessage(self::PROC_INVALID_ORDER_MESSAGE);
		}
	}

    /**
     * @param DomainModelInterface $order
     * @param int $amountMag
     * @param array $checkingItems
     */
	public function addDeliveryCostLargeItem(
	    DomainModelInterface $order,
        $amountMag = self::PROC_AMOUNT_MAGNIFIER,
        $checkingItems = self::PROC_CHECKING_ITEMS
    ) {
		foreach ($order->getItems() as $item) {
			if (in_array($item, $checkingItems)) {
				$order->totalAmount += $amountMag;
			}
		}
	}
}
