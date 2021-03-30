<?php

namespace App\Models\Events;

abstract class Event
{
    protected $eventName;

    public function getEventName(): string
    {
        return $this->eventName;
    }
}