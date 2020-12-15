<?php
declare(strict_types=1);

namespace App\Processors;

use App\Models\DomainModelInterface;

/**
 * Class OutputProcessor
 * @package App\Processors
 */
class OutputProcessor
{
    /**
     * @var string
     */
    private static $outputBuffer = '';

    /**
     * @param string $message
     */
    public function message(string $message)
    {
        static::$outputBuffer .= $message;
    }

    /**
     * @param DomainModelInterface $order
     */
    public function printResult(DomainModelInterface $order)
    {
        if ($order->isValid()) {
            $lines = explode("\n", static::$outputBuffer);

            $lineWithoutDebugInfo = [];
            foreach ($lines as $line) {
                if (strpos($line, 'Reason:') === false) {
                    $lineWithoutDebugInfo[] = $line;
                }
            }
        }

        $dataToWrite = implode("\n", $lineWithoutDebugInfo ?? [static::$outputBuffer]);
        file_put_contents('orderProcessLog', $dataToWrite, FILE_APPEND);

        if ($order->isValid()) {
            file_put_contents('result', implode('-', [
                    $order->getOrderId(),
                    implode(',', $order->getItems()),
                    $order->getDeliveryDetails(),
                    $order->isManual(),
                    $order->getTotalAmount(),
                    $order->getName() . "\n"
                ]),
                FILE_APPEND
            );
        }
    }
}
