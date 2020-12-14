<?php

namespace App\Processors;

use App\Factories\ValidatorFactory;
use App\Detalizators\DeliveryDetailsInterface;
use App\Models\DomainModelInterface;

/**
 * Class AbstractOrderProcessor
 * @package App\Processors
 */
abstract class AbstractOrderProcessor
{
    const PROC_START_MESSAGE         = "Processing started, OrderId: %s\n";
    const PROC_VALID_ORDER_MESSAGE   = "Order is valid\n";
    const PROC_INVALID_ORDER_MESSAGE = "Order is invalid\n";
    const PROC_MANUAL_ORDER_MESSAGE  = "Order '%s' NEEDS MANUAL PROCESSING\n";
    const PROC_AUTO_ORDER_MESSAGE    = "Order '%s' WILL BE PROCESSED AUTOMATICALLY\n";

	/**
	 * @var DeliveryDetailsInterface
	 */
    protected $deliveryDetails;

    /**
     * @var ValidatorFactory
     */
    protected $validatorFactory;

    /**
     * @var OutputProcessor
     */
    protected $outputProcessor;

    /**
     * AbstractOrderProcessor constructor.
     * @param DeliveryDetailsInterface $deliveryDetails
     * @param ValidatorFactory $validatorFactory
     * @param OutputProcessor $outputProcessor
     */
	public function __construct(
	    DeliveryDetailsInterface $deliveryDetails,
        ValidatorFactory $validatorFactory,
        OutputProcessor $outputProcessor
    ) {
		$this->deliveryDetails  = $deliveryDetails;
		$this->validatorFactory = $validatorFactory;
		$this->outputProcessor  = $outputProcessor;
	}

	/**
	 * @param $order DomainModelInterface
	 */
	public function process(DomainModelInterface $order)
	{
        $this->outputProcessor->startOutputProcessing(sprintf(self::PROC_START_MESSAGE, $order->orderId));

		$this->validateProcessOrder($order);

		$this->outputProcessor->printResult($order, $this->outputProcessor->endOutputProcessing());
	}

    /**
     * @param DomainModelInterface $order
     * @return mixed
     */
	abstract public function validateProcessOrder(DomainModelInterface $order);

    /**
     * @param DomainModelInterface $order
     * @param int $amountMag
     * @param array $checkingItems
     */
    abstract public function addDeliveryCostLargeItem(DomainModelInterface $order, int $amountMag, array $checkingItems);
}
