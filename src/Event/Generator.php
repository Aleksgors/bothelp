<?php

namespace App\Event;

use Exception;
use Ramsey\Uuid\Uuid;
use App\Options\Application as AppOptions;

/**
 * Class Generator
 * @package App\Event
 */
class Generator
{
    /**
     * @return array
     * @throws Exception
     */
    public function generate(): array
    {
        $userId = rand(0, AppOptions::ACCOUNTS_AMOUNT);
        $eventAmount = rand(1, AppOptions::EVENTS_AMOUNT_PER_SEND);

        $events = [
            'userId' => $userId,
            'events' => [],
        ];

        for ($i = 0; $i < $eventAmount; $i++) {
            $events['events'][] = [
                'guid' => Uuid::uuid4()->toString(),
            ];
        }

        return $events;
    }
}
