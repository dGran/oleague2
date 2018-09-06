<?php

namespace App\Events;

class TableWasDeleted
{
    public $reg;
    public $title;

    public function __construct($reg, $title)
    {
        $this->reg = $reg;
        $this->title = $title;
    }
}
