<?php

namespace App\Service;

use App\Integration\EventDTO;
use App\Options\Connection;
use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\Options\Application as AppOptions;

/**
 * Class QueueService
 * @package App\Service
 */
class QueueService
{
    protected $channel;

    /**
     * QueueService constructor
     */
    public function __construct()
    {
        $connection = new AMQPStreamConnection(
            Connection::HOST,
            Connection::PORT,
            Connection::USER,
            Connection::PASS,
            Connection::V_HOST
        );

        $this->channel = $connection->channel();
        $this->channel->queue_declare(Connection::QUEUE, false, false, false, false);
    }

    /**
     * @param EventDTO $event
     * @return void
     */
    public function publishTask(EventDTO $event): void
    {
        $msg = new AMQPMessage(serialize($event));
        $this->channel->basic_publish($msg, '', Connection::QUEUE);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function receive(): void
    {
        while ($this->channel->is_open()) {
            $msg = $this->channel->basic_get(Connection::QUEUE, true);
            $this->handleMessage($msg->body);
        }

        $this->channel->close();
        $this->channel->getConnection()->close();
    }

    public function handleMessage($body)
    {
        sleep(AppOptions::HANDLING_DELAY);

        /** @var EventDTO $event */
        $event = unserialize($body);

        echo $event->getEventGuid() . PHP_EOL;
    }
}
