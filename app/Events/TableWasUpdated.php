<?php

namespace App\Events;

class TableWasUpdated extends Event
{
    public $reg;
    public $title;

    public function __construct($reg, $title)
    {
        $this->reg = $reg;
        $this->title = $title;
    }

}
