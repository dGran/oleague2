<?php

namespace App\Listeners;

use App\Events\TableWasSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\AdminLog;

class PostInAdminLog
{
    public function __construct()
    {
        //
    }

    public function handle(TableWasSaved $event)
    {
        $table = $event->reg->getTable();

        $log = new AdminLog;
        $log->user_id = auth()->id();
        $log->table = $table;
        $log->reg_id = $event->reg->id;
        $log->type = "INSERT";
        $log->description = 'Nuevo registro insertado "' . $event->title . '"';

        $log->save();
    }
}
