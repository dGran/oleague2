<?php

namespace App\Listeners;

use App\Events\TableWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\AdminLog;

class DeleteInAdminLog
{
    public function __construct()
    {
        //
    }

    public function handle(TableWasDeleted $event)
    {
        $table = $event->reg->getTable();

        $log = new AdminLog;
        $log->user_id = auth()->id();
        $log->table = $table;
        $log->reg_id = $event->reg->id;
        $log->type = "DELETE";
        $log->description = 'Equipo "' . $event->title . '" eliminado' ;

        $log->save();
    }
}
