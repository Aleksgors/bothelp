<?php

namespace App\Options;

/**
 * Class Logger
 * @package App\Options
 */
class Logger
{
    private const LOGS_PATH = __DIR__ . '/../../data/logs/';
    private const EVENTS_LOG_NAME = 'events.log';

    public const EVENTS_LOG_PATH = self::LOGS_PATH . self::EVENTS_LOG_NAME;
}