<?php

namespace App\Listeners;

use App\Events\TableWasImported;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\AdminLog;

class ImportInAdminLog
{
    public function __construct()
    {
        //
    }

    public function handle(TableWasImported $event)
    {
        $table = $event->reg->getTable();

        $log = new AdminLog;
        $log->user_id = auth()->id();
        $log->table = $table;
        $log->reg_id = $event->reg->id;
        $log->type = "INSERT";
        $log->description = 'Nuevo equipo importado "' . $event->title . '"';

        $log->save();
    }
}
