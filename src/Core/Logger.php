<?php

namespace App\Core;

use App\Options\Logger as LoggerOptions;

/**
 * Class Logger
 * @package App\Core
 */
class Logger
{
    /**
     * @param string $string
     * @return void
     */
    public function log(string $string): void
    {
        file_put_contents(
            LoggerOptions::EVENTS_LOG_PATH,
            $string . PHP_EOL,
            FILE_APPEND
        );
    }
}
