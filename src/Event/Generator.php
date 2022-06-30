<?php

namespace App\Event;

use Exception;
use Ramsey\Uuid\Uuid;

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
        $userId = rand(0, 1000);
        $eventAmount = rand(1, 10);

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
