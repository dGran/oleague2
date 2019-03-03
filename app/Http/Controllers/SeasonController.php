<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminFilter;
use App\GeneralSetting;
use App\Season;
use App\PlayerDB;
use App\Player;
use App\SeasonParticipant;
use App\SeasonParticipantCashHistory;
use App\SeasonPlayer;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonController extends Controller
{
    public function index()
    {
        $admin = AdminFilter::where('user_id', '=', \Auth::user()->id)->first();
        if ($admin) {
            $filterName = request()->filterName;
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
            if (!$page) {
                if ($admin->season_page) {
                    $page = $admin->season_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->season_filterName) {
                    $filterName = $admin->season_filterName;
                }
                if ($admin->season_order) {
                    $order = $admin->season_order;
                }
                if ($admin->season_pagination) {
                    $pagination = $admin->season_pagination;
                }
            }
        } else {
            $admin = AdminFilter::create([
                'user_id' => \Auth::user()->id,
            ]);
            $filterName = request()->filterName;
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
        }

        $adminFilter = AdminFilter::find($admin->id);
        $adminFilter->season_filterName = $filterName;
        $adminFilter->season_order = $order;
        $adminFilter->season_pagination = $pagination;
        $adminFilter->season_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('season_page')) {
            $page = 1;
            $adminFilter->season_page = $page;
        }
        $adminFilter->save();

        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }

        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        $seasons = Season::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $seasons = Season::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->season_page = $page;
            $adminFilter->save();
        }
        return view('admin.seasons.index', compact('seasons', 'filterName', 'order', 'pagination', 'page'));
    }

    public function add()
    {
        $databases = PlayerDB::orderBy('name', 'desc')->get();
        return view('admin.seasons.add', compact('databases'));
    }

    public function save()
    {
        $data = request()->validate([
            'name' => 'required|unique:seasons,name',
        ],
        [
            'name.required' => 'El nombre de la temporada es obligatorio',
            'name.unique' => 'El nombre de la temporada ya existe',
        ]);

        $data = request()->all();
        $data['slug'] = str_slug(request()->name);
        $data['num_participants'] = (is_null(request()->num_participants)) ? 0 : request()->num_participants;
        $data['participant_has_team'] = (is_null(request()->participant_has_team)) ? 0 : 1;
        $data['use_economy'] = (is_null(request()->use_economy)) ? 0 : 1;
        if (request()->use_economy) {
            $data['initial_budget'] = (is_null(request()->initial_budget)) ? 0 : request()->initial_budget;
        } else {
            $data['initial_budget'] = 0;
        }
        $data['use_rosters'] = (is_null(request()->use_rosters)) ? 0 : 1;
        $data['players_db_id'] = (is_null(request()->players_db_id)) ? 0 : request()->players_db_id;
        $data['min_players'] = (is_null(request()->use_rosters)) ? 0 : request()->min_players;
        $data['max_players'] = (is_null(request()->use_rosters)) ? 0 : request()->max_players;

        $season = Season::create($data);

        if ($season->save()) {
            event(new TableWasSaved($season, $season->name));
            $this->createParticipants($season->num_participants, $season, request()->use_economy);

            if (request()->players_db_id > 0) {
                $this->importPlayers($season, request()->players_db_id);
            }


            if (request()->active_season) {
                $settings = GeneralSetting::first();
                if (!$settings) {
                    $settings = new GeneralSetting;
                    $settings->active_season_id = $season->id;
                    $settings->save();
                    event(new TableWasSaved($settings, 'Opciones generales'));
                } else {
                    $settings->active_season_id = $season->id;
                    $settings->save();
                    event(new TableWasUpdated($settings, 'Opciones generales'));
                }
            }

            if (request()->no_close) {
                return back()->with('success', 'Nueva temporada registrada correctamente');
            }
            return redirect()->route('admin.seasons')->with('success', 'Nueva temporada registrada correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $databases = PlayerDB::orderBy('name', 'desc')->get();
        $season = Season::find($id);
        if ($season) {
            return view('admin.seasons.edit', compact('season', 'databases'));
        } else {
            return back()->with('warning', 'Acción cancelada. La temporada que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $season = Season::find($id);

        if ($season) {
            $data = request()->validate([
                'name' => 'required|unique:seasons,name,' .$season->id,
            ],
            [
                'name.required' => 'El nombre de la temporada es obligatorio',
                'name.unique' => 'El nombre de la temporada ya existe',
            ]);

            $data = request()->all();
            $data['slug'] = str_slug(request()->name);
            $data['num_participants'] = (is_null(request()->num_participants)) ? 0 : request()->num_participants;
            $data['participant_has_team'] = (is_null(request()->participant_has_team)) ? 0 : 1;
            $data['use_economy'] = (is_null(request()->use_economy)) ? 0 : 1;
            if (is_null(request()->use_economy)) {
                $data['initial_budget'] = 0;
            } else {
                $data['initial_budget'] = (is_null(request()->initial_budget)) ? 0 : request()->initial_budget;
            }
            $data['use_rosters'] = (is_null(request()->use_rosters)) ? 0 : 1;
            $data['min_players'] = (is_null(request()->use_rosters)) ? 0 : request()->min_players;
            $data['max_players'] = (is_null(request()->use_rosters)) ? 0 : request()->max_players;
            $data['players_db_id'] = (is_null(request()->use_rosters)) ? 0 : request()->players_db_id;

            // detect if there are changes in the number of participants
            if ($season->num_participants != request()->num_participants) {
                // check if exists participants
                if ($season->participants->count()>0) {
                    // evaluate if we have to add or remove participants
                    if (request()->num_participants > $season->num_participants) {
                        // create the new participants
                        $num_new_participants = request()->num_participants - $season->num_participants;
                        $this->createParticipants($num_new_participants, $season, request()->use_economy);
                    } else {
                        $num_leftover_participants = $season->num_participants - request()->num_participants;
                        // ask if there are participants without assigned user
                        $participants_ok_for_delete = SeasonParticipant::where('season_id', '=', $season->id)
                        ->where('user_id', '=', null)
                        ->get();
                        $num_more_participants_will_delete = $num_leftover_participants - $participants_ok_for_delete->count();
                        if ($participants_ok_for_delete->count() > $num_leftover_participants) {
                            $deleted_par = 0;
                            foreach ($participants_ok_for_delete as $participant) {
                                if ($deleted_par < $num_leftover_participants) {
                                    foreach ($participant->cash_history as $cash_history) {
                                        event(new TableWasDeleted($cash_history, $cash_history->description));
                                        $cash_history->delete();
                                    }
                                    event(new TableWasDeleted($participant, $participant->name()));
                                    $participant->delete();
                                    $deleted_par++;
                                }
                            }
                        } else {
                            foreach ($participants_ok_for_delete as $participant) {
                                foreach ($participant->cash_history as $cash_history) {
                                    event(new TableWasDeleted($cash_history, $cash_history->description));
                                    $cash_history->delete();
                                }
                                event(new TableWasDeleted($participant, $participant->name()));
                                $participant->delete();
                            }
                            $deleted_par = 0;
                            foreach ($season->participants as $participant) {
                                if ($deleted_par < $num_more_participants_will_delete) {
                                    foreach ($participant->cash_history as $cash_history) {
                                        event(new TableWasDeleted($cash_history, $cash_history->description));
                                        $cash_history->delete();
                                    }
                                    event(new TableWasDeleted($participant, $participant->name()));
                                    $participant->delete();
                                    $deleted_par++;
                                }
                            }
                        }
                    }
                } else {
                    $this->createParticipants(request()->num_participants, $season, request()->use_economy);
                }
            }

            // detect if there are changes in economy and initial budget
            if (request()->use_economy) {
                // check if you already have cash history or you have to create it
                $participants = SeasonParticipant::where('season_id', '=', $season->id)->get();
                foreach ($participants as $participant) {
                    if ($participant->cash_history->count() == 0) {
                        $cash_history = new SeasonParticipantCashHistory;
                        $cash_history->participant_id = $participant->id;
                        $cash_history->description = "Presupuesto inicial";
                        $cash_history->amount = request()->initial_budget;
                        $cash_history->movement = "E";
                        $cash_history->save();
                        if ($cash_history->save()) {
                            event(new TableWasSaved($cash_history, $cash_history->description));
                        }
                    } else {
                        if ($season->initial_budget != request()->initial_budget) {
                            foreach ($participants as $participant) {
                                $participant->cash_history->first()->amount = request()->initial_budget;
                                $participant->cash_history->first()->movement = "E";
                                $participant->cash_history->first()->save();
                                if ($participant->cash_history->first()->save()) {
                                    event(new TableWasUpdated($participant->cash_history->first(), $participant->cash_history->first()->description));
                                }
                            }
                        }
                    }
                }
            } else {
                $participants = SeasonParticipant::where('season_id', '=', $season->id)->get();
                foreach ($participants as $participant) {
                    foreach ($participant->cash_history as $cash_history) {
                        $cash_history->delete();
                        if ($cash_history->delete()) {
                            event(new TableWasDeleted($cash_history, $cash_history->description));
                        }
                    }
                }
            }

            if (!request()->use_rosters) {
                $this->deletePlayers($season);
            }

            if ($season->players_db_id != request()->players_db_id) {
                $this->deletePlayers($season);
                if (request()->players_db_id > 0) {
                    $this->importPlayers($season, request()->players_db_id);
                }
            }

            $season->fill($data);

            if ($season->isDirty()) {
                $season->update($data);

                if ($season->update()) {
                    event(new TableWasUpdated($season, $season->name));

                    return redirect()->route('admin.seasons')->with('success', 'Cambios guardados en la temporada "' . $season->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.seasons')->with('info', 'No se han detectado cambios en la temporada "' . $season->name . '".');

        } else {
            return redirect()->route('admin.seasons')->with('warning', 'Acción cancelada. La temporada que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $season = Season::find($id);

        if ($season) {
            // delete season participants and cash_history
            if ($season->participants) {
                foreach ($season->participants as $participant) {
                    foreach ($participant->cash_history as $cash_history) {
                        event(new TableWasDeleted($cash_history, $cash_history->description));
                        $cash_history->delete();
                    }
                    event(new TableWasDeleted($participant, $participant->name()));
                    $participant->delete();
                }
            }
            // delete season players
            if ($season->players) {
                foreach ($season->players as $player) {
                    event(new TableWasDeleted($player, $player->name));
                    $player->delete();
                }
            }

            $message = 'Se ha eliminado la temporada "' . $season->name . '" correctamente.';

            event(new TableWasDeleted($season, $season->name));
            $season->delete();

            return redirect()->route('admin.seasons')->with('success', $message);
        } else {
            $message = 'Acción cancelada. La temporada que querías eliminar ya no existe. Se ha actualizado la lista';
            return back()->with('warning', $message);
        }
    }

    public function destroyMany($ids)
    {
        $ids=explode(",",$ids);
        $counter_deleted = 0;
        $counter_no_allow = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $season = Season::find($ids[$i]);
            if ($season) {

                // delete season participants and cash_history
                if ($season->participants) {
                    foreach ($season->participants as $participant) {
                        foreach ($participant->cash_history as $cash_history) {
                            event(new TableWasDeleted($cash_history, $cash_history->description));
                            $cash_history->delete();
                        }
                        event(new TableWasDeleted($participant, $participant->name()));
                        $participant->delete();
                    }
                }
                // delete season players
                if ($season->players) {
                    foreach ($season->players as $player) {
                        event(new TableWasDeleted($player, $player->name));
                        $player->delete();
                    }
                }
                event(new TableWasDeleted($season, $season->name));
                $season->delete();
                $counter_deleted = 1;
                // if (!$season->hasTeams()) {
                //     $counter_deleted = $counter_deleted +1;
                //     event(new TableWasDeleted($season, $season->name));
                //     $season->delete();
                // } else {
                //     $counter_no_allow = $counter_no_allow +1;
                // }
            }
        }
        if ($counter_deleted > 0) {
            if ($counter_no_allow > 0) {
                return redirect()->route('admin.seasons')->with('success', 'Se han eliminado las temporadas seleccionadas correctamente excepto las que tienen xxxx asociados.');
            } else {
                return redirect()->route('admin.seasons')->with('success', 'Se han eliminado las temporadas seleccionadas correctamente.');
            }
        } else {
            if ($counter_no_allow > 0) {
                return back()->with('warning', 'Acción cancelada. No es posible eliminar las temporadas seleccionadas ya que tienen xxxxx asociados.');
            } else {
                return back()->with('warning', 'Acción cancelada. La temporadas que querías eliminar ya no existen.');
            }
        }
    }

    public function duplicate($id)
    {
        $season = Season::find($id);

        if ($season) {
            $newseason = $season->replicate();
            $newseason->name .= " (copia)";
            $newseason->slug = str_slug($newseason->name);

            $newseason->save();

            if ($newseason->save()) {
                event(new TableWasSaved($newseason, $newseason->name));
            }

            return redirect()->route('admin.seasons')->with('success', 'Se ha duplicado la temporada "' . $newseason->name . '" correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. La temporada que querías duplicar ya no existe. Se ha actualizado la lista.');
        }
    }

    public function duplicateMany($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Season::find($ids[$i]);
            if ($original) {
                $counter = $counter +1;
                $season = $original->replicate();
                $season->name .= " (copia)";
                $season->slug = str_slug($season->name);

                $season->save();

                if ($season->save()) {
                    event(new TableWasSaved($season, $season->name));
                }
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.seasons')->with('success', 'Se han duplicado las temporadas seleccionadas correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Las temporadas que querías duplicar ya no existen. Se ha actualizado la lista.');
        }
    }

    public function exportFile($filename, $type, $filterName, $order, $ids = null)
    {
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        if ($filterName == "null") { $filterName =""; }

        if ($ids) {
            $ids = explode(",",$ids);
            $seasons = Season::whereIn('id', $ids)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $seasons = Season::name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'temporadas_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($seasons) {
            $excel->sheet('temporadas', function($sheet) use ($seasons)
            {
                $sheet->fromArray($seasons);
            });
        })->download($type);
    }

    public function importFile(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = \Excel::load($path)->get();

            if ($data->count()) {
                foreach ($data as $key => $value) {
                    try {
                        $season = new Season;
                        $season->name = $value->name;
                        $season->slug = str_slug($value->name);

                        if ($season) {
                            $season->save();
                            if ($season->save()) {
                                event(new TableWasImported($season, $season->name));
                            }
                        }
                    }
                    catch (\Exception $e) {
                        return back()->with('error', 'Fallo al importar los datos, el archivo es inválido o no tiene el formato necesario.');
                    }
                }
                return back()->with('success', 'Datos importados correctamente.');
            } else {
                return back()->with('error', 'Fallo al importar los datos, el archivo no contiene datos.');
            }
        }
        return back()->with('error', 'No has cargado ningún archivo.');
    }

    public function setActiveSeason($id)
    {
        $settings = GeneralSetting::first();
        if (!$settings) {
            $settings = new GeneralSetting;
            $settings->active_season_id = $id;
            $settings->save();
            event(new TableWasSaved($settings, 'Opciones generales'));
        } else {
            $settings->active_season_id = $id;
            $settings->save();
            event(new TableWasUpdated($settings, 'Opciones generales'));
        }

        return back()->with('success', 'Temporada activa establecida correctamente');
    }


    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order) {
        $order_ext = [
            'default' => [
                'sortField'     => 'id',
                'sortDirection' => 'desc'
            ],
            'date' => [
                'sortField'     => 'id',
                'sortDirection' => 'asc'
            ],
            'date_desc' => [
                'sortField'     => 'id',
                'sortDirection' => 'desc'
            ],
            'name' => [
                'sortField'     => 'name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'name',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }

    protected function createParticipants($new_participants, $season, $use_economy) {
        for ($i=1; $i < $new_participants+1; $i++) {
            $participant = new SeasonParticipant;
            $participant->season_id = $season->id;
            $participant->team_id = null;
            $participant->user_id = null;
            $participant->paid_clauses = 0;
            $participant->clauses_received = 0;
            $participant->save();
            if ($participant->save()) {
                event(new TableWasSaved($participant, $participant->name()));
            }

            if ($use_economy) {
                $cash_history = new SeasonParticipantCashHistory;
                $cash_history->participant_id = $participant->id;
                $cash_history->description = "Presupuesto inicial";
                $cash_history->amount = $season->initial_budget;
                $cash_history->movement = "E";
                $cash_history->save();
                if ($cash_history->save()) {
                    event(new TableWasSaved($cash_history, $cash_history->description));
                }
            }
        }
    }

    protected function importPlayers($season, $players_db_id) {
        $players = Player::where('players_db_id', '=', $players_db_id)->get();

        foreach ($players as $player) {
            $season_player = SeasonPlayer::create([
                'season_id' => $season->id,
                'player_id' => $player->id,
            ]);
            event(new TableWasImported($season_player, $player->name . " en " . $season->name));
        }
    }

    protected function deletePlayers($season) {
        $players = SeasonPlayer::where('season_id', '=', $season->id)->get();
        foreach ($players as $player) {
            event(new TableWasDeleted($player, $player->name));
            $player->delete();
        }
    }
}