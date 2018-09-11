<?php

namespace App\Listeners;

use App\Events\TableWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\AdminLog;

class UpdateInAdminLog
{
    public function __construct()
    {
        //
    }

    public function handle(TableWasUpdated $event)
    {
        $table = $event->reg->getTable();

        $log = new AdminLog;
        $log->user_id = auth()->id();
        $log->table = $table;
        $log->reg_id = $event->reg->id;
        $log->type = "UPDATE";
        $log->description = 'Registro "' . $event->title . '" editado' ;

        $log->save();
    }
}
