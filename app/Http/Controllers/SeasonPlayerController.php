<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\SeasonPlayer;
use App\SeasonParticipant;
use App\Player;
use App\AdminFilter;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonPlayerController extends Controller
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
                if ($admin->seasonPlayers_page) {
                    $page = $admin->seasonPlayers_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->seasonPlayers_filterSeason) {
                    if (Season::find($admin->seasonPlayers_filterSeason)) {
                        $filterSeason = $admin->seasonPlayers_filterSeason;
                    }
                }
                if ($admin->seasonPlayers_order) {
                    $order = $admin->seasonPlayers_order;
                }
                if ($admin->seasonPlayers_pagination) {
                    $pagination = $admin->seasonPlayers_pagination;
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
        $adminFilter->seasonPlayers_filterSeason = $filterSeason;
        $adminFilter->seasonPlayers_order = $order;
        $adminFilter->seasonPlayers_pagination = $pagination;
        $adminFilter->seasonPlayers_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('seasonPlayers_page')) {
            $page = 1;
            $adminFilter->seasonPlayers_page = $page;
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

        $active_season = Season::find($filterSeason);

        $players = SeasonPlayer::select('season_players.*')->join('players', 'players.id', '=', 'season_players.player_id')
        ->seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        $seasons = Season::orderBy('name', 'asc')->get();
        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $players = SeasonPlayer::select('season_players.*')->join('players', 'players.id', '=', 'season_players.player_id')
            ->seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->seasonPlayers_page = $page;
            $adminFilter->save();
        }
        return view('admin.seasons_players.index', compact('players', 'seasons', 'filterSeason', 'active_season', 'order', 'pagination', 'page'));
    }

    public function add($season_id)
    {
        $participants = SeasonParticipant::where('season_id', '=', $season_id)->get();
        $season_name = Season::find($season_id)->name;
        $players = \DB::table("players")->select('*')
        ->whereNotIn('id', function($query) use ($season_id) {
           $query->select('player_id')->from('season_players')->whereNotNull('player_id')->where('season_id', '=', $season_id);
        })
        ->orderBy('name', 'asc')
        ->get();
        return view('admin.seasons_players.add', compact('season_id', 'season_name', 'players', 'participants'));
    }

    public function save()
    {
        $data = request()->all();
        $data['active'] = (is_null(request()->active)) ? 0 : 1;
        $player = SeasonPlayer::create($data);

        if ($player->save()) {
            event(new TableWasSaved($player, $player->player->name));
            if (request()->no_close) {
                return back()->with('success', 'Nuevo jugador registrado correctamente');
            }
            return redirect()->route('admin.season_players')->with('success', 'Nuevo jugador registrado correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $player = SeasonPlayer::find($id);
        if ($player) {
            $participants = SeasonParticipant::where('season_id', '=', $player->season_id)->get();
            return view('admin.seasons_players.edit', compact('player', 'participants'));
        } else {
            return back()->with('warning', 'Acción cancelada. El jugador que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $player = SeasonPlayer::find($id);

        if ($player) {
            $data = request()->all();
            $data['active'] = (is_null(request()->active)) ? 0 : 1;

            $player->fill($data);
            if ($player->isDirty()) {
                $player->update($data);

                if ($player->update()) {
                    event(new TableWasUpdated($player, $player->player->name));
                    return redirect()->route('admin.season_players')->with('success', 'Cambios guardados en el jugador "' . $player->player->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.season_players')->with('info', 'No se han detectado cambios en el jugador "' . $player->player->name . '".');

        } else {
            return redirect()->route('admin.season_players')->with('warning', 'Acción cancelada. El jugador que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $player = SeasonPlayer::find($id);

        if ($player) {
            event(new TableWasDeleted($player, $player->player->name));
            $message = 'Se ha eliminado el jugador "' . $player->player->name . '" correctamente.';
            $player->delete();

            return redirect()->route('admin.season_players')->with('success', $message);
        } else {
            $message = 'Acción cancelada. El jugador que querías eliminar ya no existe. Se ha actualizado la lista';
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
            $player = SeasonPlayer::find($ids[$i]);
            if ($player) {
                if ($player->allowDelete()) {
                    $counter_deleted = $counter_deleted +1;
                    event(new TableWasDeleted($player, $player->player->name));
                    $player->delete();
                } else {
                    $counter_no_allow = $counter_no_allow +1;
                }
            }
        }
        if ($counter_deleted > 0) {
            if ($counter_no_allow > 0) {
                return redirect()->route('admin.season_players')->with('success', 'Se han eliminado los jugadores seleccionadas correctamente excepto las que pertenecen a algún participante.');
            } else {
                return redirect()->route('admin.season_players')->with('success', 'Se han eliminado los jugadores seleccionados correctamente.');
            }
        } else {
            if ($counter_no_allow > 0) {
                return back()->with('warning', 'Acción cancelada. No es posible eliminar los jugadores seleccionadas ya que pertenecen a participantes.');
            } else {
                return back()->with('warning', 'Acción cancelada. Los jugadores que querías eliminar ya no existen.');
            }
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
            'name' => [
                'sortField'     => 'players.name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'players.name',
                'sortDirection' => 'desc'
            ],
            'overall' => [
                'sortField'     => 'players.overall_rating',
                'sortDirection' => 'asc'
            ],
            'overall_desc' => [
                'sortField'     => 'players.overall_rating',
                'sortDirection' => 'desc'
            ],
            'age' => [
                'sortField'     => 'players.age',
                'sortDirection' => 'asc'
            ],
            'age_desc' => [
                'sortField'     => 'players.age',
                'sortDirection' => 'desc'
            ],
            'height' => [
                'sortField'     => 'players.height',
                'sortDirection' => 'asc'
            ],
            'height_desc' => [
                'sortField'     => 'players.height',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }

}