<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\User;
use App\Team;
use App\Season;
use App\AdminFilter;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;
use Illuminate\Support\Str;

class SeasonParticipantController extends Controller
{
    public function index()
    {
        $admin = AdminFilter::where('user_id', '=', \Auth::user()->id)->first();
        if ($admin) {
            if (request()->filterSeason == null) {
                if (active_season()) {
                    $filterSeason = active_season()->id;
                } else {
                    $seasons = Season::all();
                    if ($seasons->isNotEmpty()) {
                        $filterSeason = $seasons->last()->id;
                    } else {
                        $filterSeason = '';
                    }
                }
            } else {
                $filterSeason = request()->filterSeason;
            }
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
            if (!$page) {
                if ($admin->seasonParticipants_page) {
                    $page = $admin->seasonParticipants_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->seasonParticipants_filterSeason) {
                    if (Season::find($admin->seasonParticipants_filterSeason)) {
                        $filterSeason = $admin->seasonParticipants_filterSeason;
                    }
                }
                if ($admin->seasonParticipants_order) {
                    $order = $admin->seasonParticipants_order;
                }
                if ($admin->seasonParticipants_pagination) {
                    $pagination = $admin->seasonParticipants_pagination;
                }
            }
        } else {
            $admin = AdminFilter::create([
                'user_id' => \Auth::user()->id,
            ]);
            if (request()->filterSeason == null) {
                if (active_season()) {
                    $filterSeason = active_season()->id;
                } else {
                    $seasons = Season::all();
                    if ($seasons->isNotEmpty()) {
                        $filterSeason = $seasons->last()->id;
                    } else {
                        $filterSeason = '';
                    }
                }
            } else {
                $filterSeason = request()->filterSeason;
            }
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
        }


        $adminFilter = AdminFilter::find($admin->id);
        $adminFilter->seasonParticipants_filterSeason = $filterSeason;
        $adminFilter->seasonParticipants_order = $order;
        $adminFilter->seasonParticipants_pagination = $pagination;
        $adminFilter->seasonParticipants_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('seasonParticipants_page')) {
            $page = 1;
            $adminFilter->seasonParticipants_page = $page;
        }
        $adminFilter->save();

        $active_season = Season::find($filterSeason);

        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }

        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);


        if ($active_season->participant_has_team) {
            $participants = SeasonParticipant::
            leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
            ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
            ->seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        } else {
            if ($order == 'team' || $order == 'team_desc') {
                if ($order == 'team') {
                    $order = 'user';
                } else {
                    $order = 'user_desc';
                }
                $order_ext = $this->getOrder($order);
            }
            $participants = SeasonParticipant::
            leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'users.name as user_name')
            ->seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        }
        $seasons = Season::orderBy('name', 'asc')->get();
        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            if ($active_season->participant_has_team) {
                $participants = SeasonParticipant::
                leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
                ->leftJoin('users', 'users.id', '=', 'season_participants.user_id')
                ->select('season_participants.*', 'teams.name as team_name', 'users.name as user_name')
                ->seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            } else {
                if ($order == 'team' || $order == 'team_desc') {
                    if ($order == 'team') {
                        $order = 'user';
                    } else {
                        $order = 'user_desc';
                    }
                    $order_ext = $this->getOrder($order);
                }
                $participants = SeasonParticipant::
                leftJoin('users', 'users.id', '=', 'season_participants.user_id')
                ->select('season_participants.*', 'users.name as user_name')
                ->seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            }
            $adminFilter->seasonParticipants_page = $page;
            $adminFilter->save();
        }

        return view('admin.seasons_participants.index', compact('participants', 'seasons', 'filterSeason', 'active_season', 'order', 'pagination', 'page'));
    }

    public function add($season_id)
    {
        $teams = \DB::table("teams")->select('*')
                ->whereNotIn('id', function($query) use ($season_id) {
                   $query->select('team_id')->from('season_participants')->whereNotNull('team_id')->where('season_id', '=', $season_id);
                })
                ->orderBy('name', 'asc')
                ->get();
        $users = \DB::table("users")->select('*')
                ->whereNotIn('id', function($query) use ($season_id) {
                   $query->select('user_id')->from('season_participants')->whereNotNull('user_id')->where('season_id', '=', $season_id);
                })
                ->orderBy('name', 'asc')
                ->get();
        $season = Season::find($season_id);
    	return view('admin.seasons_participants.add', compact('season', 'users', 'teams'));
    }

    public function save()
    {
        $data = request()->all();
        $participant = SeasonParticipant::create($data);

        if ($participant->save()) {
            event(new TableWasSaved($participant, $participant->name()));
            $season = Season::find($participant->season_id);
            if ($season) {
                $season->num_participants = $season->participants->count();
                $season->save();
                event(new TableWasUpdated($season, $season->name, 'Número de participantes, valor ' . $season->num_participants));
            }
            if (request()->no_close) {
                return back()->with('success', 'Nuevo participante registrado correctamente');
            }
            return redirect()->route('admin.season_participants')->with('success', 'Nuevo participante registrado correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $participant = SeasonParticipant::find($id);
        $teams = \DB::table('teams')->select('*')
                ->whereNotIn('id', function($query) use ($participant) {
                   $query->select('team_id')->from('season_participants')->whereNotNull('team_id')->where('season_id', '=', $participant->season_id);
                })
                ->orderBy('name', 'asc')
                ->get();
        $users = \DB::table("users")->select('*')
                ->whereNotIn('id', function($query) use ($participant) {
                   $query->select('user_id')->from('season_participants')->whereNotNull('user_id')->where('season_id', '=', $participant->season_id);
                })
                ->orderBy('name', 'asc')
                ->get();
        if ($participant) {
            return view('admin.seasons_participants.edit', compact('participant', 'teams', 'users'));
        } else {
            return back()->with('warning', 'Acción cancelada. El participante que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $participant = SeasonParticipant::find($id);

        if ($participant) {
            $data = request()->all();

            $participant->fill($data);
            if ($participant->isDirty()) {
                $participant->update($data);

                if ($participant->update()) {
                    event(new TableWasUpdated($participant, $participant->name()));
                    return redirect()->route('admin.season_participants')->with('success', 'Cambios guardados en el participante "' . $participant->name() . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.season_participants')->with('info', 'No se han detectado cambios en el participante "' . $participant->name() . '".');

        } else {
            return redirect()->route('admin.season_participants')->with('warning', 'Acción cancelada. El participante que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function kickout($id)
    {
        $participant = SeasonParticipant::find($id);

        if ($participant) {

            $participant->user_id = null;
            $participant->save();

            if ($participant->update()) {
                event(new TableWasUpdated($participant, $participant->name()));
                return redirect()->route('admin.season_participants')->with('success', 'Usuario expulsado en el participante "' . $participant->name() . '" correctamente.');
            } else {
                return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
            }

        } else {
            return redirect()->route('admin.season_participants')->with('warning', 'Acción cancelada. El participante del que quer querías expulsar al usuario ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $participant = SeasonParticipant::find($id);

        if ($participant) {
            $message = 'Se ha eliminado el participante "' . $participant->name() . '" correctamente.';

            foreach ($participant->cash_history as $cash_history) {
                event(new TableWasDeleted($cash_history, $cash_history->description));
                $cash_history->delete();
            }
            foreach ($participant->players as $player) {
                $player->participant_id = NULL;
                $player->save();
                if ($player->save()) {
                    event(new TableWasUpdated($player, $player->player->name, 'Cambio de equipo: Libre'));
                }
            }
            event(new TableWasDeleted($participant, $participant->name()));
            $participant->delete();

            $season = Season::find($participant->season_id);
            if ($season) {
                $season->num_participants = $season->participants->count();
                $season->save();
                event(new TableWasUpdated($season, $season->name, 'Número de participantes, valor ' . $season->num_participants));
            }

            return redirect()->route('admin.season_participants')->with('success', $message);
        } else {
            $message = 'Acción cancelada. El participante que querías eliminar ya no existe. Se ha actualizado la lista';
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
            $participant = SeasonParticipant::find($ids[$i]);
            if ($participant) {
                // if (!$participant->hasTeams()) {
                    $counter_deleted = $counter_deleted +1;
                    foreach ($participant->cash_history as $cash_history) {
                        event(new TableWasDeleted($cash_history, $cash_history->description));
                        $cash_history->delete();
                    }
                    event(new TableWasDeleted($participant, $participant->name()));
                    $participant->delete();
                // } else {
                    // $counter_no_allow = $counter_no_allow +1;
                // }
            }
        }
        $season = Season::find($participant->season_id);
        if ($season) {
            $season->num_participants = $season->participants->count();
            $season->save();
            event(new TableWasUpdated($season, $season->name, 'Número de participantes, valor ' . $season->num_participants));
        }
        if ($counter_deleted > 0) {
            // if ($counter_no_allow > 0) {
                // return redirect()->route('admin.teams_categories')->with('success', 'Se han eliminado las categorías seleccionadas correctamente excepto las que tienen equipos asociados.');
            // } else {
                return redirect()->route('admin.season_participants')->with('success', 'Se han eliminado los participantes seleccionados correctamente.');
            // }
        } else {
            // if ($counter_no_allow > 0) {
                // return back()->with('warning', 'Acción cancelada. No es posible eliminar las categorías seleccionadas ya que tienen equipos asociados.');
            // } else {
                return back()->with('warning', 'Acción cancelada. Los participantes que querías eliminar ya no existen.');
            // }
        }
    }

    public function exportFile($filename, $type, $filterSeason, $order, $ids = null)
    {
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        if ($filterSeason == "null") { $filterSeason =""; }

        if ($ids) {
            $ids = explode(",",$ids);
            $participants = SeasonParticipant::whereIn('id', $ids)
                ->seasonId($filterSeason)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $participants = SeasonParticipant::seasonId($filterSeason)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'participantes_export' . time();
        } else {
            $filename = Str::slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($participants) {
            $excel->sheet('participantes', function($sheet) use ($participants)
            {
                $sheet->fromArray($participants);
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
                        $participant = new SeasonParticipant;
                        $participant->season_id = $value->season_id;
                        $participant->team_id = $value->team_id;
                        $participant->user_id = $value->user_id;
                        $participant->paid_clauses = $value->paid_clauses;
                        $participant->clauses_received = $value->clauses_received;

                        if ($participant) {
                            $participant->save();
                            if ($participant->save()) {
                                event(new TableWasImported($participant, $participant->name()));
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

    public function cashHistory($id) {
        $participant = SeasonParticipant::find($id);
        if ($participant) {
            return view('admin.seasons_participants.index.cash_history', compact('participant'))->render();
        } else {
            return view('admin.seasons_participants.index.cash_history_empty')->render();
        }
    }

    public function roster($id) {
        $participant = SeasonParticipant::find($id);
        if ($participant) {
            return view('admin.seasons_participants.index.roster', compact('participant'))->render();
        } else {
            return view('admin.seasons_participants.index.roster_empty')->render();
        }
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
            'team' => [
                'sortField'     => 'team_name',
                'sortDirection' => 'asc'
            ],
            'team_desc' => [
                'sortField'     => 'team_name',
                'sortDirection' => 'desc'
            ],
            'user' => [
                'sortField'     => 'user_name',
                'sortDirection' => 'asc'
            ],
            'user_desc' => [
                'sortField'     => 'user_name',
                'sortDirection' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }
}
