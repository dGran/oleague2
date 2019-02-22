<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\SeasonPlayer;
use App\Player;
use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonPlayerController extends Controller
{
    public function index()
    {
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
        $active_season = Season::find($filterSeason);

        $order = request()->order;
        $pagination = request()->pagination;

        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }

        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        $players = SeasonPlayer::seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
        $seasons = Season::orderBy('name', 'asc')->get();

    	return view('admin.seasons_players.index', compact('players', 'seasons', 'filterSeason', 'active_season', 'order', 'pagination'));
    }

    public function import_full_roster()
    {
    	$players = Player::where('players_db_id', '=', 3)->get();

    	foreach ($players as $player) {
	        $season_player = SeasonPlayer::create([
	            'season_id' => active_season()->id,
	            'player_id' => $player->id,
	        ]);
	        event(new TableWasImported($season_player, $player->name . " en " . active_season()->name));
    	}

    	return redirect()->route('admin.season_players')->with('info', 'Se han importado todos los jugadores de la database seleccionada');

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

}