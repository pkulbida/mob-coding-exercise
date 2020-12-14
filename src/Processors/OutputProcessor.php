<?php

namespace App\Processors;

class OutputProcessor
{
    /**
     * @param $message
     */
    public function startOutputProcessing($message)
    {
        ob_start();
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
}
