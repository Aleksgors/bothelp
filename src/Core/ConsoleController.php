<?php

namespace App\Core;

use App\Event\Generator;
use App\Integration\EventDTO;
use App\Service\QueueService;
use DateTime;
use Exception;

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

    protected $eventHandler;

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
                $eventDTO = new EventDTO();
                $eventDTO
                    ->setUserId($userId)
                    ->setEventGuid($event['guid'])
                    ->setReceiveDateTime(new DateTime());

                $this->queueService->publishTask($eventDTO);
            }

            $eventsCount += count($events);

            if ($eventsCount >= 100) {
                break;
            }
        }
    }

    /**
     * @return void
     */
    public function handleAction()
    {
        $this->queueService->receive();
    }
}
