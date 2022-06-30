<?php

namespace App\Service;

use App\Integration\EventDTO;
use App\Options\Connection;
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
     */
    public function receive()
    {
        $callback = function ($msg) {
            $this->handleMessage($msg->body);
        };

        $this->channel->basic_consume(
            'user.event',
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
    }

    protected function handleMessage($body)
    {
        sleep(1);
        echo $body;
    }
}
