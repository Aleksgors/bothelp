<?php

namespace App\Service;

use App\Integration\EventDTO;
use App\Options\Connection;
use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

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
        $this->channel->queue_declare('user.event', false, false, false, false);
    }

    /**
     * @param EventDTO $event
     * @return void
     */
    public function publishTask(EventDTO $event): void
    {
        $msg = new AMQPMessage(serialize($event));
        $this->channel->basic_publish($msg, '', 'user.event');
    }

    /**
     * @return void
     * @throws Exception
     */
    public function receive(): void
    {
        while ($this->channel->is_open()) {
            $msg = $this->channel->basic_get('user.event', true);
            $this->handleMessage($msg->body);
        }

        $this->channel->close();
        $this->channel->getConnection()->close();
    }

    public function handleMessage($body)
    {
        sleep(2);
        /** @var EventDTO $event */
        $event = unserialize($body);
        echo $event->getEventGuid() . PHP_EOL;
    }
}
