<?php

namespace App\Options;

/**
 * Class Application
 *
 * Конфиг приложения по требованиям задачи
 *
 * @package App\Options
 */
class Application
{
    /**
     * Задержка обработки сообщений, имитация нагрузки
     */
    public const HANDLING_DELAY = 1;

    /**
     * Количество аккаунтов
     */
    public const ACCOUNTS_AMOUNT = 1000;

    /**
     * Общее количество генерируемых сообщений в генераторе
     */
    public const EVENTS_AMOUNT = 10000;

    /**
     * Максимальное количество сообщений за один запрос на API
     */
    public const EVENTS_AMOUNT_PER_SEND = 10;
}
