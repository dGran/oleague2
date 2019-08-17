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
		$players = SeasonPlayer::select('season_players.*')
	        ->join('players', 'players.id', '=', 'season_players.player_id')
	        ->seasonId(active_season()->id)
			->where(function($q) {
          		$q->where('season_players.transferable', '=', 1)
            	  ->orWhere('season_players.player_on_loan', '=', 1);
      			});
        // $players = $players->participantId($participant->id);
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
        return view('market.sale', compact('players'));
    }

    public function myTeam()
    {
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

		return redirect()->route('login');
    }

    public function view($id) {
    	dd('llego');
        $player = Player::find($id);
        if ($player) {
            return view('admin.players.index.view', compact('player'))->render();
        } else {
            return view('admin.players.index.view-empty')->render();
        }
    }

    public function myTeamPlayer($id)
    {
        $player = SeasonPlayer::find($id);
        if ($player) {
            return view('market.my_team.view', compact('player'))->render();
        } else {
            return view('market.my_team.view-empty')->render();
        }
    }

    public function myTeamPlayerEdit($id)
    {
        $player = SeasonPlayer::find($id);
        if ($player) {
            return view('market.my_team.edit', compact('player'))->render();
        } else {
            return view('market.my_team.edit-empty')->render();
        }
    }

    public function myTeamPlayerUpdate($id)
    {
        $player = SeasonPlayer::find($id);
        if ($player) {
        	$player->salary = request()->salary;
        	$player->price = request()->price;

        	if (request()->untransferable == 'on') {
        		$player->untransferable	= 1;
        		$player->player_on_loan = 0;
        		$player->transferable = 0;
        		$player->sale_price = null;
        		$player->sale_auto_accept = 0;
        	} else {
        		$player->untransferable	= 0;
	        	$player->player_on_loan = request()->player_on_loan == 'on' ? 1 : 0;
	        	$player->transferable = request()->transferable == 'on' ? 1 : 0;
	        	$player->sale_price = request()->sale_price;
	        	$player->sale_auto_accept = request()->sale_auto_accept == 'on' ? 1 : 0;
        	}
        	$player->market_phrase = request()->market_phrase;
        	$player->save();
            return redirect()->route('market.my_team');
        } else {
			return redirect()->route('market.my_team');
        }
    }
}
