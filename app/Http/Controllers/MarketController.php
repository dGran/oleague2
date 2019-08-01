<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\SeasonPlayer;

class MarketController extends Controller
{
    public function index()
    {
        return view('market.index');
    }

    public function onSale()
    {
        return view('market.sale');
    }

    public function myTeam() {
		if (auth()->user() && user_is_participant(auth()->user()->id)) {
			$participant = SeasonParticipant::where('season_id', '=', active_season()->id)
				->where('user_id', '=', auth()->user()->id)->first();

			$players = SeasonPlayer::select('season_players.*')
		        ->join('players', 'players.id', '=', 'season_players.player_id')
		        ->seasonId(active_season()->id);
            $players = $players->participantId($participant->id);
	        // if ($filterNation != NULL) {
	        //     $players = $players->where('players.nation_name', '=', $filterNation);
	        // }
	        // if ($filterPosition != NULL) {
	        //     $players = $players->where('players.position', '=', $filterPosition);
	        // }
	        // if ($filterActive == 1) {
	        //     $players->where('active', '=', $filterActive);
	        // }
	        $players = $players->orderBy('players.overall_rating', 'desc')
		        ->orderBy('players.name', 'asc')
		        ->get();

			return view('market.my_team', compact('participant', 'players'));
		}

		dd('no soy participante');
    }
}
