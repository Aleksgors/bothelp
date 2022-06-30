<?php

namespace App\Integration;

use DateTime;

/**
 * Class EventDTO
 * @package App\Integration
 */
class EventDTO
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $eventGuid;

    /**
     * @var DateTime
     */
    protected $receiveDateTime;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventGuid()
    {
        return $this->eventGuid;
    }

    /**
     * @param mixed $eventGuid
     */
    public function setEventGuid($eventGuid): self
    {
        $this->eventGuid = $eventGuid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceiveDateTime()
    {
        return $this->receiveDateTime;
    }

    /**
     * @param mixed $receiveDateTime
     */
    public function setReceiveDateTime($receiveDateTime): self
    {
        $this->receiveDateTime = $receiveDateTime;
        return $this;
    }
}
