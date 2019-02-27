<?php

namespace App\Events;

class TableWasDeleted extends Event
{
    public $reg;
    public $title;

    public function __construct($reg, $title, $description = null)
    {
        $this->reg = $reg;
        $this->title = $title;
        $this->description = $description;
    }
}
