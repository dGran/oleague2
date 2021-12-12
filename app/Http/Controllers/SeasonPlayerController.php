<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\SeasonPlayer;
use App\SeasonPlayerPack;
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
        if (request()->filterParticipant == NULL) { request()->filterParticipant = 0; }

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
            $filterParticipant = request()->filterParticipant;
            $filterName = request()->filterName;
            $filterTeam = request()->filterTeam;
            $filterLeague = request()->filterLeague;
            $filterNation = request()->filterNation;
            $filterPosition = request()->filterPosition;
            $filterPack = request()->filterPack;
            if (request()->filterActive) {
                $filterActive = 1;
            } else {
                $filterActive = 0;
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
                if ($admin->seasonPlayers_filterParticipant) {
                    $filterParticipant = $admin->seasonPlayers_filterParticipant;
                }
                if ($admin->seasonPlayers_filterName) {
                    $filterName = $admin->seasonPlayers_filterName;
                }
                if ($admin->seasonPlayers_filterTeam) {
                    $filterTeam = $admin->seasonPlayers_filterTeam;
                }
                if ($admin->seasonPlayers_filterLeague) {
                    $filterLeague = $admin->seasonPlayers_filterLeague;
                }
                if ($admin->seasonPlayers_filterNation) {
                    $filterNation = $admin->seasonPlayers_filterNation;
                }
                if ($admin->seasonPlayers_filterPosition) {
                    $filterPosition = $admin->seasonPlayers_filterPosition;
                }
                if ($admin->seasonPlayers_filterPack) {
                    $filterPack = $admin->seasonPlayers_filterPack;
                }
                if ($admin->seasonPlayers_filterActive) {
                    $filterActive = $admin->seasonPlayers_filterActive;
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
            $filterParticipant = request()->filterParticipant;
            $filterName = request()->filterName;
            $filterTeam = request()->filterTeam;
            $filterLeague = request()->filterLeague;
            $filterNation = request()->filterNation;
            $filterPosition = request()->filterPosition;
            $filterPack = request()->filterPack;
            if (request()->filterActive) {
                $filterActive = 1;
            } else {
                $filterActive = 0;
            }
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
        }


        $adminFilter = AdminFilter::find($admin->id);
        $adminFilter->seasonPlayers_filterSeason = $filterSeason;
        $adminFilter->seasonPlayers_filterParticipant = $filterParticipant;
        $adminFilter->seasonPlayers_filterName = $filterName;
        $adminFilter->seasonPlayers_filterTeam = $filterTeam;
        $adminFilter->seasonPlayers_filterLeague = $filterLeague;
        $adminFilter->seasonPlayers_filterNation = $filterNation;
        $adminFilter->seasonPlayers_filterPosition = $filterPosition;
        $adminFilter->seasonPlayers_filterPack = $filterPack;
        $adminFilter->seasonPlayers_filterActive = $filterActive;
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

        $players = SeasonPlayer::select('season_players.*')
        ->join('players', 'players.id', '=', 'season_players.player_id')
        ->seasonId($filterSeason);
        if ($filterParticipant >= 0) {
            $players = $players->participantId($filterParticipant);
        }
        $players = $players->where('players.name', 'LIKE', '%' . $filterName . '%');
        if ($filterTeam != NULL) {
            $players = $players->where('players.team_name', '=', $filterTeam);
        }
        if ($filterLeague != NULL) {
            $players = $players->where('players.league_name', '=', $filterLeague);
        }
        if ($filterNation != NULL) {
            $players = $players->where('players.nation_name', '=', $filterNation);
        }
        if ($filterPosition != NULL) {
            $players = $players->where('players.position', '=', $filterPosition);
        }
        if ($filterPack > 0) {
            $players = $players->where('season_players.pack_id', '=', $filterPack);
        }
        if ($filterActive == 1) {
            $players->where('active', '=', $filterActive);
        }
        $players = $players->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
        ->orderBy('players.name', 'asc')
        ->paginate($perPage, ['*'], 'page', $page);


        $positions = Player::select('position')->distinct()->where('players_db_id', '=', Season::find($filterSeason)->players_db_id)->orderBy('position', 'asc')->get();
        $nations = Player::select('nation_name')->distinct()->where('players_db_id', '=', Season::find($filterSeason)->players_db_id)->orderBy('nation_name', 'asc')->get();
        $teams = Player::select('team_name')->distinct()->where('players_db_id', '=', Season::find($filterSeason)->players_db_id)->orderBy('team_name', 'asc')->get();
        $leagues = Player::select('league_name')->distinct()->where('players_db_id', '=', Season::find($filterSeason)->players_db_id)->orderBy('league_name', 'asc')->get();
        $packs = SeasonPlayerPack::where('season_id', '=', $filterSeason)->orderBy('name', 'asc')->get();

        if (Season::find($filterSeason)->participant_has_team) {
            $participants = SeasonParticipant::
            leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
            ->select('season_participants.*', 'teams.name as team_name')
            ->seasonId($filterSeason)->orderBy('team_name', 'asc')->get();
        } else {
            $participants = SeasonParticipant::
            leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'users.name as user_name')
            ->seasonId($filterSeason)->orderBy('user_name', 'asc')->get();
        }

        $seasons = Season::where('use_rosters', '=', 1)->orderBy('name', 'asc')->get();
        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $players = SeasonPlayer::select('season_players.*')
            ->join('players', 'players.id', '=', 'season_players.player_id')
            ->seasonId($filterSeason);
            if ($filterParticipant >= 0) {
                $players = $players->participantId($filterParticipant);
            }
            $players = $players->where('players.name', 'LIKE', '%' . $filterName . '%');
            if ($filterTeam != NULL) {
                $players = $players->where('players.team_name', '=', $filterTeam);
            }
            if ($filterLeague != NULL) {
                $players = $players->where('players.league_name', '=', $filterLeague);
            }
            if ($filterNation != NULL) {
                $players = $players->where('players.nation_name', '=', $filterNation);
            }
            if ($filterPosition != NULL) {
                $players = $players->where('players.position', '=', $filterPosition);
            }
            if ($filterPack > 0) {
                $players = $players->where('season_players.pack_id', '=', $filterPack);
            }
            if ($filterActive == 1) {
                $players->where('active', '=', $filterActive);
            }
            $players = $players->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
            ->orderBy('players.name', 'asc')
            ->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->seasonPlayers_page = $page;
            $adminFilter->save();
        }
        return view('admin.seasons_players.index', compact('players', 'seasons', 'participants', 'teams', 'leagues', 'nations', 'positions', 'packs', 'filterSeason', 'filterParticipant', 'filterName', 'filterTeam', 'filterLeague', 'filterNation', 'filterPosition', 'filterPack', 'filterActive', 'active_season', 'order', 'pagination', 'page'));
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

    // public function view($id) {
    //     $player = Player::find($id);
    //     if ($player) {
    //         return view('admin.players.index.view', compact('player'))->render();
    //     } else {
    //         return view('admin.players.index.view-empty')->render();
    //     }
    // }

    public function activate($id)
    {
        $player = SeasonPlayer::find($id);
        if ($player) {
            $player->active = 1;
            $player->save();
            if ($player->save()) {
                event(new TableWasUpdated($player, $player->player->name, "Jugador activado"));
            }
        }
        return redirect()->route('admin.season_players')->with('success', 'Se ha activado el jugador correctamente.');
    }

    public function activateMany($ids)
    {
        $ids=explode(",",$ids);
        $counter_activated = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $player = SeasonPlayer::find($ids[$i]);
            if ($player) {
                if ($player->active == 0) {
                    $counter_activated = $counter_activated +1;
                    $player->active = 1;
                    $player->save();
                    event(new TableWasUpdated($player, $player->player->name, 'Jugador activado'));
                }
            }
        }
        if ($counter_activated > 0) {
            return redirect()->route('admin.season_players')->with('success', 'Se han activado los jugadores seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Todos los jugadores seleccionados ya estaban activados.');
        }
    }

    public function desactivate($id)
    {
        $player = SeasonPlayer::find($id);
        if ($player) {
            $player->active = 0;
            $player->save();
            if ($player->save()) {
                event(new TableWasUpdated($player, $player->player->name, "Jugador desactivado"));
            }
        }
        return redirect()->route('admin.season_players')->with('success', 'Se ha desactivado el jugador correctamente.');
    }

    public function desactivateMany($ids)
    {
        $ids=explode(",",$ids);
        $counter_desactivated = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $player = SeasonPlayer::find($ids[$i]);
            if ($player) {
                if ($player->active == 1) {
                    $counter_desactivated = $counter_desactivated +1;
                    $player->active = 0;
                    $player->save();
                    event(new TableWasUpdated($player, $player->player->name, 'Jugador desactivado'));
                }
            }
        }
        if ($counter_desactivated > 0) {
            return redirect()->route('admin.season_players')->with('success', 'Se han desactivado los jugadores seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Todos los jugadores seleccionados ya estaban desactivados.');
        }
    }

    public function reset($season_id)
    {
        $players = SeasonPlayer::seasonId($season_id)->where('participant_id', '>', 0)->orWhereNull('participant_id')->orWhere('salary', '!=', '0.5')->get();
        $counter_reset = 0;
        foreach ($players as $player) {
            $player->participant_id = 0;
            $player->salary = 0.5;
            $player->price = 5;
            $player->save();
            event(new TableWasUpdated($player, $player->player->name, 'Jugador reseteado'));
            $counter_reset++;
        }
        if ($counter_reset > 0) {
            return redirect()->route('admin.season_players')->with('success', 'Se han reseteado todos los jugadores correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Todos los jugadores ya estaban reseteados.');
        }
    }


    public function resetMany($ids)
    {
        $ids=explode(",",$ids);
        for ($i=0; $i < count($ids); $i++)
        {
            $player = SeasonPlayer::find($ids[$i]);
            if ($player) {
                $player->participant_id = 0;
                $player->salary = 0.5;
                $player->price = 5;
                $player->save();
                event(new TableWasUpdated($player, $player->player->name, 'Jugador reseteado'));
            }
        }
        return redirect()->route('admin.season_players')->with('success', 'Se han reseteado los jugadores seleccionados correctamente.');
    }

    public function transferMany($ids, $participant_id)
    {
        $participant = SeasonParticipant::find($participant_id);
        $ids=explode(",",$ids);
        for ($i=0; $i < count($ids); $i++)
        {
            $player = SeasonPlayer::find($ids[$i]);
            if ($player) {
                $player->participant_id = $participant_id;
                $player->save();
                if ($participant) {
                    $text = "Jugador transferido participante " . $participant->name();
                } else {
                    $text = "Jugador convertido en agente libre";
                }
                event(new TableWasUpdated($player, $player->player->name, $text));
            }
        }
        if ($participant) {
            return redirect()->route('admin.season_players')->with('success', 'Se han asignado los jugadores seleccionados al participante ' . $participant->name() . ' correctamente.');
        }
        return redirect()->route('admin.season_players')->with('success', 'Se han convertido en agentes libres los jugadores seleccionados correctamente.');
    }

    public function transferPackMany($ids, $pack_id)
    {
        $pack = SeasonPlayerPack::find($pack_id);
        $ids=explode(",",$ids);
        for ($i=0; $i < count($ids); $i++)
        {
            $player = SeasonPlayer::find($ids[$i]);
            if ($player) {
                $player->pack_id = $pack_id;
                $player->save();
                if ($pack) {
                    $text = "Jugador asignado al pack " . $pack->name;
                } else {
                    $text = "Jugador liberado de los packs";
                }
                event(new TableWasUpdated($player, $player->player->name, $text));
            }
        }
        if ($pack) {
            return redirect()->route('admin.season_players')->with('success', 'Se han asignado los jugadores seleccionados al pack ' . $pack->name . ' correctamente.');
        }
        return redirect()->route('admin.season_players')->with('success', 'Se han liberado de los packs a los jugadores seleccionados correctamente.');
    }

    public function activeAllPlayers($season_id)
    {
        $players = SeasonPlayer::where('season_id', '=', $season_id)->where('active', '=', 0)->get();
        foreach ($players as $player) {
            $player->active = 1;
            $player->save();
            if ($player->save()) {
                event(new TableWasUpdated($player, $player->player->name, "Jugador activado"));
            }
        }
        return redirect()->route('admin.season_players')->with('success', 'Se han activado todos los jugadores correctamente.');
    }

    public function desactiveAllPlayers($season_id)
    {
        $players = SeasonPlayer::where('season_id', '=', $season_id)->where('active', '=', 1)->get();
        foreach ($players as $player) {
            $player->active = 0;
            $player->save();
            if ($player->save()) {
                event(new TableWasUpdated($player, $player->player->name, "Jugador desactivado"));
            }
        }
        return redirect()->route('admin.season_players')->with('success', 'Se han desactivado todos los jugadores correctamente.');
    }

    public function generatePacks($season_id)
    {
        $season_participants = SeasonParticipant::where('season_id', '=', $season_id)->orderBy('id', 'asc')->get();
        //player 1
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['DC', 'SD', 'EI', 'ED'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32];
        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 2
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['PT'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 31, 30, 29, 28, 27, 26, 25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        // $order = [24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        $order = [22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 3
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['CT', 'LD', 'LI'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 31, 30, 29, 28, 27, 26, 25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        // $order = [24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        $order = [22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 4
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['MC', 'MCD'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32];
        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 5
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['PT'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32];
        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }
                // return back();


        //player 6
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['LD', 'LI'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [16, 17, 15, 18, 14, 19, 13, 20, 12, 21, 11, 22, 10, 23, 9, 24, 8, 25, 7, 26, 6, 27, 5, 28, 4, 29, 3, 30, 2, 31, 1, 32];
        // $order = [12, 13, 11, 14, 10, 15, 9, 16, 8, 17, 7, 18, 6, 19, 5, 20, 4, 21, 3, 22, 2, 23, 1, 24];
        $order = [11, 12, 10, 13, 9, 14, 8, 15, 7, 16, 6, 17, 5, 18, 4, 19, 3, 20, 2, 21, 1, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }


        //player 7
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['LD', 'LI'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 31, 30, 29, 28, 27, 26, 25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        // $order = [24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        $order = [22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 8
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['LD', 'LI'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32];
        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 9
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['ED', 'EI', 'ID', 'II', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 1, 31, 2, 30, 3, 29, 4, 28, 5, 27, 6, 26, 7, 25, 8, 24, 9, 23, 10, 22, 11, 21, 12, 20 ,13, 19, 14, 18, 15, 17, 16];
        // $order = [24, 1, 23, 2, 22, 3, 21, 4, 20, 5, 19, 6, 18, 7, 17, 8, 16, 9, 15, 10, 14, 11, 13, 12];
        $order = [22, 1, 21, 2, 20, 3, 19, 4, 18, 5, 17, 6, 16, 7, 15, 8, 14, 9, 13, 10, 12, 11];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 10
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['ED', 'EI', 'ID', 'II', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [16, 17, 15, 18, 14, 19, 13, 20, 12, 21, 11, 22, 10, 23, 9, 24, 8, 25, 7, 26, 6, 27, 5, 28, 4, 29, 3, 30, 2, 31, 1, 32];
        // $order = [12, 13, 11, 14, 10, 15, 9, 16, 8, 17, 7, 18, 6, 19, 5, 20, 4, 21, 3, 22, 2, 23, 1, 24];
        $order = [11, 12, 10, 13, 9, 14, 8, 15, 7, 16, 6, 17, 5, 18, 4, 19, 3, 20, 2, 21, 1, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 11
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['ED', 'EI', 'ID', 'II', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 31, 30, 29, 28, 27, 26, 25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        // $order = [24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        $order = [22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 12
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['ED', 'EI', 'ID', 'II', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32];
        // $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        $order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 13
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['CT'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();


        // $order = [16, 17, 15, 18, 14, 19, 13, 20, 12, 21, 11, 22, 10, 23, 9, 24, 8, 25, 7, 26, 6, 27, 5, 28, 4, 29, 3, 30, 2, 31, 1, 32];
        // $order = [12, 13, 11, 14, 10, 15, 9, 16, 8, 17, 7, 18, 6, 19, 5, 20, 4, 21, 3, 22, 2, 23, 1, 24];
        $order = [11, 12, 10, 13, 9, 14, 8, 15, 7, 16, 6, 17, 5, 18, 4, 19, 3, 20, 2, 21, 1, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 14
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['CT'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 1, 31, 2, 30, 3, 29, 4, 28, 5, 27, 6, 26, 7, 25, 8, 24, 9, 23, 10, 22, 11, 21, 12, 20 ,13, 19, 14, 18, 15, 17, 16];
        // $order = [24, 1, 23, 2, 22, 3, 21, 4, 20, 5, 19, 6, 18, 7, 17, 8, 16, 9, 15, 10, 14, 11, 13, 12];
        $order = [22, 1, 21, 2, 20, 3, 19, 4, 18, 5, 17, 6, 16, 7, 15, 8, 14, 9, 13, 10, 12, 11];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 15
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['CT'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [16, 17, 15, 18, 14, 19, 13, 20, 12, 21, 11, 22, 10, 23, 9, 24, 8, 25, 7, 26, 6, 27, 5, 28, 4, 29, 3, 30, 2, 31, 1, 32];
        // $order = [12, 13, 11, 14, 10, 15, 9, 16, 8, 17, 7, 18, 6, 19, 5, 20, 4, 21, 3, 22, 2, 23, 1, 24];
        $order = [11, 12, 10, 13, 9, 14, 8, 15, 7, 16, 6, 17, 5, 18, 4, 19, 3, 20, 2, 21, 1, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 16
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['CT'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 1, 31, 2, 30, 3, 29, 4, 28, 5, 27, 6, 26, 7, 25, 8, 24, 9, 23, 10, 22, 11, 21, 12, 20 ,13, 19, 14, 18, 15, 17, 16];
        // $order = [24, 1, 23, 2, 22, 3, 21, 4, 20, 5, 19, 6, 18, 7, 17, 8, 16, 9, 15, 10, 14, 11, 13, 12];
        $order = [22, 1, 21, 2, 20, 3, 19, 4, 18, 5, 17, 6, 16, 7, 15, 8, 14, 9, 13, 10, 12, 11];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 17
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['MC', 'MCD', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [16, 17, 15, 18, 14, 19, 13, 20, 12, 21, 11, 22, 10, 23, 9, 24, 8, 25, 7, 26, 6, 27, 5, 28, 4, 29, 3, 30, 2, 31, 1, 32];
        // $order = [12, 13, 11, 14, 10, 15, 9, 16, 8, 17, 7, 18, 6, 19, 5, 20, 4, 21, 3, 22, 2, 23, 1, 24];
        $order = [11, 12, 10, 13, 9, 14, 8, 15, 7, 16, 6, 17, 5, 18, 4, 19, 3, 20, 2, 21, 1, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 18
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['MC', 'MCD', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 1, 31, 2, 30, 3, 29, 4, 28, 5, 27, 6, 26, 7, 25, 8, 24, 9, 23, 10, 22, 11, 21, 12, 20 ,13, 19, 14, 18, 15, 17, 16];
        // $order = [24, 1, 23, 2, 22, 3, 21, 4, 20, 5, 19, 6, 18, 7, 17, 8, 16, 9, 15, 10, 14, 11, 13, 12];
        $order = [22, 1, 21, 2, 20, 3, 19, 4, 18, 5, 17, 6, 16, 7, 15, 8, 14, 9, 13, 10, 12, 11];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 19
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['MC', 'MCD', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [16, 17, 15, 18, 14, 19, 13, 20, 12, 21, 11, 22, 10, 23, 9, 24, 8, 25, 7, 26, 6, 27, 5, 28, 4, 29, 3, 30, 2, 31, 1, 32];
        // $order = [12, 13, 11, 14, 10, 15, 9, 16, 8, 17, 7, 18, 6, 19, 5, 20, 4, 21, 3, 22, 2, 23, 1, 24];
        $order = [11, 12, 10, 13, 9, 14, 8, 15, 7, 16, 6, 17, 5, 18, 4, 19, 3, 20, 2, 21, 1, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 20
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['MC', 'MCD', 'MP'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 1, 31, 2, 30, 3, 29, 4, 28, 5, 27, 6, 26, 7, 25, 8, 24, 9, 23, 10, 22, 11, 21, 12, 20 ,13, 19, 14, 18, 15, 17, 16];
        // $order = [24, 1, 23, 2, 22, 3, 21, 4, 20, 5, 19, 6, 18, 7, 17, 8, 16, 9, 15, 10, 14, 11, 13, 12];
        $order = [22, 1, 21, 2, 20, 3, 19, 4, 18, 5, 17, 6, 16, 7, 15, 8, 14, 9, 13, 10, 12, 11];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 21
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['DC', 'SD'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [16, 17, 15, 18, 14, 19, 13, 20, 12, 21, 11, 22, 10, 23, 9, 24, 8, 25, 7, 26, 6, 27, 5, 28, 4, 29, 3, 30, 2, 31, 1, 32];
        // $order = [12, 13, 11, 14, 10, 15, 9, 16, 8, 17, 7, 18, 6, 19, 5, 20, 4, 21, 3, 22, 2, 23, 1, 24];
        $order = [11, 12, 10, 13, 9, 14, 8, 15, 7, 16, 6, 17, 5, 18, 4, 19, 3, 20, 2, 21, 1, 22];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }

        //player 22
        $players = SeasonPlayer::select('season_players.*', 'players.name', 'players.position', 'players.overall_rating')
            ->leftjoin('players', 'players.id', '=', 'season_players.player_id')
            ->where('season_players.season_id', "=", $season_id)
            ->where('season_players.participant_id', "=", 0)
            ->where('season_players.active', '=', 1)
            ->whereIn('players.position', ['DC', 'SD'])
            ->orderBy('players.overall_rating', 'desc')
            // ->limit(32)
            // ->limit(24)
            ->limit(22)
            ->get();

        // $order = [32, 1, 31, 2, 30, 3, 29, 4, 28, 5, 27, 6, 26, 7, 25, 8, 24, 9, 23, 10, 22, 11, 21, 12, 20 ,13, 19, 14, 18, 15, 17, 16];
        // $order = [24, 1, 23, 2, 22, 3, 21, 4, 20, 5, 19, 6, 18, 7, 17, 8, 16, 9, 15, 10, 14, 11, 13, 12];
        $order = [22, 1, 21, 2, 20, 3, 19, 4, 18, 5, 17, 6, 16, 7, 15, 8, 14, 9, 13, 10, 12, 11];
        foreach ($players as $key => $player) {
            $season_player = SeasonPlayer::find($player->id);
            $season_player->participant_id = $season_participants[$order[$key]-1]->id;
            $season_player->save();
        }


        return back();

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
            'position' => [
                'sortField'     => 'players.position',
                'sortDirection' => 'asc'
            ],
            'position_desc' => [
                'sortField'     => 'players.position',
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
