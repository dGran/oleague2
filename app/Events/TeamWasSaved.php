<?php

namespace App\Events;

class TeamWasSaved extends Event
{
    public $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

}
