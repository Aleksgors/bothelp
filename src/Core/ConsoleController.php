<?php

namespace App\Core;

use App\Event\Generator;
use App\Integration\EventDTO;
use App\Service\QueueService;
use DateTime;
use Exception;
use App\Options\Application as AppOptions;

/**
 * Class ConsoleController
 * @package App\Core
 */
class ConsoleController
{
    /** @var Generator */
    protected $eventsGenerator;

    /** @var QueueService */
    protected $queueService;

    /**
     * ConsoleController constructor
     */
    public function __construct()
    {
        $this->eventsGenerator = new Generator();
        $this->queueService = new QueueService();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function generateAction(): void
    {
        $eventsCount = 0;

        while (true) {
            $eventsPack = $this->eventsGenerator->generate();

            $events = $eventsPack['events'];
            $userId = $eventsPack['userId'];

            foreach ($events as $event) {
                $eventDTO = $this->createDto();
                $eventDTO
                    ->setUserId($userId)
                    ->setEventGuid($event['guid'])
                    ->setReceiveDateTime(new DateTime());

                $this->queueService->publishTask($eventDTO);
            }

            $eventsCount += count($events);

            if ($eventsCount >= AppOptions::EVENTS_AMOUNT) {
                break;
            }

            sleep(rand(0, 2));
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function handleAction(): void
    {
        $this->queueService->receive();
    }

    /**
     * @return void
     */
    public function consumeAction(): void
    {
        for ($i = 1; $i <= AppOptions::WORKERS_AMOUNT; $i++) {
            exec("php " . __DIR__ . "/../../public/index.php events_handle >/dev/null 2>&1 &");
        }
    }

    /**
     * @return EventDTO
     */
    protected function createDto(): EventDTO
    {
        return new EventDTO();
    }
}
