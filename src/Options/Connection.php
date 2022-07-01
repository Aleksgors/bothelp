<?php

namespace App\Options;

/**
 * Class Connection
 * @package App\Options
 */
class Connection
{
    public const HOST = 'bot-help.rabbitmq.host';
    public const PORT = '5672';
    public const USER = 'developer';
    public const PASS = 'developer';
    public const V_HOST = 'bothelp';

    public const QUEUE = 'user.event';
}