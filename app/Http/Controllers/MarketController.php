<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\SeasonPlayer;
use App\SeasonParticipantCashHistory as Cash;

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
    	if (auth()->guest()) {
    		return redirect()->route('market')->with('info', 'La página ha expirado debido a la inactividad.');
    	} else {
			if (user_is_participant(auth()->user()->id)) {
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
    	}

		return redirect()->route('market')->with('info', 'Debes ser participante para tener acceso.');
    }

    public function view($id) {
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
    	if (auth()->guest()) {
    		return redirect()->route('market')->with('info', 'La página ha expirado debido a la inactividad.');
    	} else {
	        $player = SeasonPlayer::find($id);
	        if ($player) {
    			if (auth()->user()->id == $player->participant->user_id) {
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
		        	if ($player->save()) {
		            	return redirect()->route('market.my_team')->with('success', 'Jugador editado correctamente.');
		        	} else {
		        		return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
		        	}
    			} else {
    				return back()->with('error', 'Acción cancelada. Ya no eres propietario del jugador');
    			}
	        } else {
				return redirect()->route('market.my_team')->with('error', 'El jugador ya no existe en la base de datos.');
	        }
    	}
    }

    public function tagsTransferable($id)
    {
    	if (auth()->guest()) {
    		return back()->with('info', 'La página ha expirado debido a la inactividad.');
    	} else {
	        $player = SeasonPlayer::find($id);
	        if ($player) {
	        	if (auth()->user()->id == $player->participant->user_id) {
		        	$player->transferable = 1;
		        	$player->untransferable = 0;
		        	$player->save();
		        	if ($player->save()) {
		            	return redirect()->route('market.my_team')->with('success', $player->player->name . ' ha sido declarado transferible.');
		        	} else {
		        		return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
		        	}
	        	} else {
	        		return back()->with('error', 'Acción cancelada. Ya no eres propietario del jugador');
	        	}
	        }
	        return back();
    	}
    }

    public function tagsUntransferable($id)
    {
    	if (auth()->guest()) {
    		return back()->with('info', 'La página ha expirado debido a la inactividad.');
    	} else {
	        $player = SeasonPlayer::find($id);
	        if ($player) {
	        	if (auth()->user()->id == $player->participant->user_id) {
		        	$player->untransferable = 1;
		    		$player->player_on_loan = 0;
		    		$player->transferable = 0;
		    		$player->sale_price = null;
		    		$player->sale_auto_accept = 0;
		    		$player->market_phrase = null;
		        	$player->save();
		        	if ($player->save()) {
		            	return redirect()->route('market.my_team')->with('success', $player->player->name . ' ha sido declarado intransferible.');
		        	} else {
		        		return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
		        	}
	        	} else {
	        		return back()->with('error', 'Acción cancelada. Ya no eres propietario del jugador');
	        	}
	        }
	        return back();
    	}
    }

    public function tagsOnLoan($id)
    {
    	if (auth()->guest()) {
    		return back()->with('info', 'La página ha expirado debido a la inactividad.');
    	} else {
	        $player = SeasonPlayer::find($id);
	        if ($player) {
	        	if (auth()->user()->id == $player->participant->user_id) {
		        	$player->player_on_loan = 1;
		        	$player->untransferable = 0;
		        	$player->save();
		        	if ($player->save()) {
		            	return redirect()->route('market.my_team')->with('success', $player->player->name . ' ha sido declarado cedible.');
		        	} else {
		        		return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
		        	}
	        	} else {
	        		return back()->with('error', 'Acción cancelada. Ya no eres propietario del jugador');
	        	}
	        }
	        return back();
    	}
    }

    public function tagsDelete($id)
    {
    	if (auth()->guest()) {
    		return back()->with('info', 'La página ha expirado debido a la inactividad.');
    	} else {
	        $player = SeasonPlayer::find($id);
	        if ($player) {
	        	if (auth()->user()->id == $player->participant->user_id) {
		        	$player->untransferable = 0;
		    		$player->player_on_loan = 0;
		    		$player->transferable = 0;
		    		$player->sale_price = null;
		    		$player->sale_auto_accept = 0;
		    		$player->market_phrase = null;
		        	$player->save();
		        	if ($player->save()) {
		            	return redirect()->route('market.my_team')->with('success', 'Se han eliminado las etiquetas de ' . $player->player->name);
		        	} else {
		        		return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
		        	}
	        	} else {
	        		return back()->with('error', 'Acción cancelada. Ya no eres propietario del jugador');
	        	}
	        }
	        return back();
    	}
    }

    public function dismiss($id)
    {
    	if (auth()->guest()) {
    		return back()->with('info', 'La página ha expirado debido a la inactividad.');
    	} else {
	        $player = SeasonPlayer::find($id);
	        if ($player) {
	        	if (auth()->user()->id == $player->participant->user_id) {
		        	$this->add_cash_history(
		        		$player->participant_id,
		        		'Despido de ' . $player->player->name,
		        		$player->season->free_players_remuneration,
		        		'E'
		        	);

		        	//generate new
		        	//generate market history

		        	$player->participant_id = null;
		        	$player->market_phrase = null;
		        	$player->untransferable = 0;
		        	$player->player_on_loan = 0;
		        	$player->transferable = 0;
		        	$player->sale_price = null;
		        	$player->sale_auto_accept = 0;
		        	$player->price = 5;
		        	$player->salary = 0.5;
		        	$player->save();
		        	if ($player->save()) {
		            	return redirect()->route('market.my_team')->with('success', $player->player->name . ' ha sido declarado despedido.');
		        	} else {
		        		return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
		        	}
	        	} else {
	        		return back()->with('error', 'Acción cancelada. Ya no eres propietario del jugador');
	        	}
	        }
	        return back();
    	}
    }

    /*
     * HELPERS FUNCTIONS
     *
     */
	protected function add_cash_history($participant_id, $description, $amount, $movement) {
	    $cash = new Cash;
	    $cash->participant_id = $participant_id;
	    $cash->description = $description;
	    $cash->amount = $amount;
	    $cash->movement = $movement;
	    $cash->save();
	}
}
