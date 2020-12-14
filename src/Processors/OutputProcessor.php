<?php

namespace App\Processors;

use App\Models\DomainModelInterface;

/**
 * Class OutputProcessor
 * @package App\Processors
 */
class OutputProcessor
{
    /**
     * @param $message
     */
    public function startOutputProcessing($message)
    {
        ob_start();

        $this->printMessage($message);
    }

    /**
     * @param $message
     */
    public function printMessage($message)
    {
        echo $message;
    }

    /**
     * @return false|string
     */
    public function endOutputProcessing()
    {
        $result = ob_get_contents();

        ob_end_clean();

        return $result;
    }

    /**
     * @param DomainModelInterface $order
     * @param $result
     */
    public function printResult(DomainModelInterface $order, $result)
    {
        if ($order->isValid()) {
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

        if ($order->isValid()) {
            file_put_contents('result', @file_get_contents('result')
                . $order->getOrderId()
                . '-' . implode(',', $order->getItems())
                . '-' . $order->getDeliveryDetails()
                . '-' . $order->isManual() //? 1 : 0)
                . '-' . $order->getTotalAmount()
                . '-' . $order->getName() . "\n"
            );
        }
    }
}
