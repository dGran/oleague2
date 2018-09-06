<?php

namespace App\Listeners;

use App\Events\TeamWasSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\AdminLog;

class AddActionInAdminLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TeamWasSaved  $event
     * @return void
     */
    public function handle(TeamWasSaved $event)
    {
        // hacer el listener global para todas las tablas
        $table = $event->team->getTable();

        $log = new AdminLog;
        $log->user_id = auth()->id();
        $log->table = $table;
        $log->reg_id = $event->team->id;
        $log->type = "INSERT";
        $log->description = 'Nuevo equipo insertado "' . $event->team->name . '"';

        $log->save();
    }
}
