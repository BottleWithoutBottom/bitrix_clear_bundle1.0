<?php

namespace App\MVC\Models\Events;

use App\Mvc\Models\Model;

abstract class Event extends Model
{
    protected $eventName;

    public function getEventName(): string
    {
        return $this->eventName;
    }
}