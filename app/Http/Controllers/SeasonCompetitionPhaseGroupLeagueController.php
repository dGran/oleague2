<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TableZone;
use App\SeasonCompetitionPhaseGroup;
use App\SeasonCompetitionPhaseGroupParticipant;
use App\SeasonCompetitionPhaseGroupLeague;
use App\SeasonCompetitionPhaseGroupLeagueDay;
use App\SeasonCompetitionPhaseGroupLeagueDayMatch;
use App\SeasonCompetitionPhaseGroupLeagueTableZone;

use Illuminate\Database\Eloquent\Collection;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonCompetitionPhaseGroupLeagueController extends Controller
{
    public function index($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $league = $this->check_league($group);
    	$table_zones = TableZone::orderBy('name', 'asc')->get();
    	if ($league->table_zones->count() == 0) {
    		foreach ($group->participants as $key => $p) {
    			$league_table_zone = new SeasonCompetitionPhaseGroupLeagueTableZone;
    			$league_table_zone->league_id = $league->id;
    			$league_table_zone->position = $key + 1;
    			$league_table_zone->save();
    		}
    	}

        return view('admin.seasons_competitions_phases_groups_leagues.index', compact('group', 'league', 'table_zones'));
    }

    public function save($competition_slug, $phase_slug, $group_slug, $id)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $league = SeasonCompetitionPhaseGroupLeague::find($id);

        if ($league) {

        	foreach ($group->participants as $key => $p) {
        		$pos = $key + 1;
        		$pos_value = request()->{"position".$pos};

        		$league_table_zone = SeasonCompetitionPhaseGroupLeagueTableZone::where('league_id', '=', $league->id)->where('position', '=', $pos)->first();
        		if ($league_table_zone) {
        			$league_table_zone->table_zone_id = $pos_value;
        			$league_table_zone->save();
        		}
        	}

            $data = request()->all();
            $data['group_id'] = $group->id;
            $data['stats_mvp'] = request()->stats_mvp ? 1 : 0;
            $data['stats_goals'] = request()->stats_goals ? 1 : 0;
            $data['stats_assists'] = request()->stats_assists ? 1 : 0;
            $data['stats_yellow_cards'] = request()->stats_yellow_cards ? 1 : 0;
            $data['stats_red_cards'] = request()->stats_red_cards ? 1 : 0;

            $league->fill($data);
            if ($league->isDirty()) {
                $league->update($data);

                if ($league->update()) {
                    event(new TableWasUpdated($league, $league->group->name));
                    return back()->with('success', 'Configuración de liga guardada correctamente');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }
            return back()->with('info', 'No se han detectado cambios en la configuración de la liga.');
        } else {
        	return back()->with('warning', 'Acción cancelada. La liga que estabas editando ya no existe, se ha regenerado el archivo.');
        }
    }

    public function calendar($competition_slug, $league_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $league = $this->check_league($group);

        return view('admin.seasons_competitions_phases_groups_leagues.calendar', compact('group', 'league'));
    }

    public function calendar_generate($competition_slug, $league_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $league = $this->check_league($group);

        // we check if there are already days and games, if so, we eliminate them before generating
        if ($league->days->count() > 0) {
        	foreach ($league->days as $day) {
				if ($day->matches->count() > 0) {
					foreach ($day->matches as $match) {
						$match->delete();
					}
				}
				$day->delete();
        	}
        }

		$second_round = request()->second_round ? 1 : 0;
		$inverse_order = request()->inverse_order ? 1 : 0;
        $this->generate_days($league->id, $second_round, $inverse_order);
        // comprobar si funciona cuando los participantes son impares y con otros numeros de participantes pares

        return back()->with('success', 'Se han generado las jornadas de la liga correctamente.');
    }

    public function table($competition_slug, $league_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $league = $this->check_league($group);

    	$table_participants = collect();
		$group_participants = SeasonCompetitionPhaseGroupParticipant::where('group_id', '=', $league->group->id)->get();
		foreach ($group_participants as $key => $participant) {
			$data = $this->get_table_data_participant($league->id, $participant->id);
			$table_participants->push([
				'participant' => $participant,
		        'pj' => $data['pj'],
		        'pg' => $data['pg'],
		        'pe' => $data['pe'],
		        'pp' => $data['pp'],
		        'ps' => $data['ps'],
		        'gf' => $data['gf'],
		        'gc' => $data['gc'],
		        'avg' => $data['avg'],
				'pts' => $data['pts'],
			]);
		}

		$table_participants = $table_participants->sortByDesc('gf')->sortByDesc('avg')->sortBy('ps')->sortByDesc('pts')->values();
		$table_participants2 = collect();
			$zones = [];
			foreach ($league->table_zones as $key => $table_zone) {
				$zones[$key] = SeasonCompetitionPhaseGroupLeagueTableZone::where('league_id', '=', $league->id)->where('position', '=', $key+1)->first()->table_zone;
			}

			foreach ($table_participants as $key => $tp) {
				$table_participants2->push([
					'participant' => $table_participants[$key]['participant'],
			        'pj' => $table_participants[$key]['pj'],
			        'pg' => $table_participants[$key]['pg'],
			        'pe' => $table_participants[$key]['pe'],
			        'pp' => $table_participants[$key]['pp'],
			        'ps' => $table_participants[$key]['ps'],
			        'gf' => $table_participants[$key]['gf'],
			        'gc' => $table_participants[$key]['gc'],
			        'avg' => $table_participants[$key]['avg'],
			        'pts' => $table_participants[$key]['pts'],
			        'table_zone' => $zones[$key],
				]);
			}
			$table_participants = $table_participants2;
		// }

        return view('admin.seasons_competitions_phases_groups_leagues.table', compact('group', 'league', 'table_participants'));
    }

    public function editMatch($competition_slug, $league_slug, $group_slug, $id)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $match = SeasonCompetitionPhaseGroupLeagueDayMatch::find($id);

        return view('admin.seasons_competitions_phases_groups_leagues.calendar.match', compact('match', 'group'))->render();
    }

    public function updateMatch($competition_slug, $league_slug, $group_slug, $id)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $match = SeasonCompetitionPhaseGroupLeagueDayMatch::find($id);

        $match->local_score = request()->local_score;
        $match->visitor_score = request()->visitor_score;
        if (request()->sanctioned_id > 0) {
        	$match->sanctioned_id = request()->sanctioned_id;
        }
        $match->save();

        return back()->with('success', 'Resultado registrado correctamente.');
    }

    public function resetMatch($competition_slug, $league_slug, $group_slug, $id)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $match = SeasonCompetitionPhaseGroupLeagueDayMatch::find($id);

        $match->local_score = null;
        $match->visitor_score = null;
        $match->sanctioned_id = null;
        $match->save();

        return back()->with('success', 'Resultado reseteado correctamente.');
    }





    // HELPER FUNCTIONS

    protected function check_league($group)
    {
        $league = SeasonCompetitionPhaseGroupLeague::where('group_id', '=', $group->id)->get()->first();

        if (!$league) {
        	$league = new SeasonCompetitionPhaseGroupLeague;
        	$league->group_id = $group->id;
        	$league->save();
        	$league = SeasonCompetitionPhaseGroupLeague::where('group_id', '=', $group->id)->get()->first();
        }

        return $league;
    }

    protected function generate_days($league_id, $second_round, $inverse_order)
    {
    	$league = SeasonCompetitionPhaseGroupLeague::find($league_id);

    	$days = SeasonCompetitionPhaseGroupLeagueDay::where('league_id', '=', $league_id)->orderBy('order', 'desc')->get();
    	if ($days->count() > 0) {
    		$next_day = $days->first()->order + 1;
    	} else {
    		$next_day = 1;
    	}

    	$group_participants = SeasonCompetitionPhaseGroupParticipant::where('group_id', '=', $league->group->id)->inRandomOrder()->get();
		$participants = [];
		$i = 1;
		foreach ($group_participants as $participant) {
			$participants[$i] = $participant;
			$i++;
		}

		$num_participants = $league->group->num_participants;

		if ($num_participants % 2 == 0) { // num_participantes par
			$num_participants = $i-1;
		} else { // num_participantes impar
			$num_participants = $i;
		}

	    $num_players = ($num_participants > 0) ? (int)$num_participants : 4;
	    // If necessary, round up number of players to nearest even number.  -- / / Si el número necesario, reunir a los jugadores de número par más cercano.
	    $num_players += $num_players % 2;

	    // Generate matches for each round
	    for ($round = 1; $round < $num_players; $round++) {
	    	$day = new SeasonCompetitionPhaseGroupLeagueDay;
	    	$day->league_id = $league_id;
	    	$day->order = $next_day;
	    	$day->save();

			$day_to_repeat[$round]=$day->id;

	        $players_done = array();

	        // Match each player, except the last one
	        for ($player = 1; $player < $num_players; $player++) {
	            if (!in_array($player, $players_done)) {
	                // Select opponent.
	                $opponent = $round - $player;
	                $opponent += ($opponent < 0) ? $num_players : 1;

	                // Securing opponent is not the current player
	                if ($opponent != $player) {
	                    if (($player + $opponent) % 2 == 0 xor $player < $opponent) {
	                    	if ($participants[$player]->id > 0 && $participants[$opponent]->id > 0) {

							   	$match = new SeasonCompetitionPhaseGroupLeagueDayMatch;
							   	$match->day_id = $day->id;
							   	$match->local_id = $participants[$player]->id;
							   	$match->local_user_id = $participants[$player]->participant->user->id;
							   	$match->visitor_id = $participants[$opponent]->id;
							   	$match->visitor_user_id = $participants[$opponent]->participant->user->id;
							   	$match->save();
	                    	}
	                    } else {
	                        if ($participants[$opponent]->id > 0 && $participants[$player]->id > 0) {
							   	$match = new SeasonCompetitionPhaseGroupLeagueDayMatch;
							   	$match->day_id = $day->id;
							   	$match->local_id = $participants[$opponent]->id;
							   	$match->local_user_id = $participants[$opponent]->participant->user->id;
							   	$match->visitor_id = $participants[$player]->id;
							   	$match->visitor_user_id = $participants[$player]->participant->user->id;
							   	$match->save();
	                        }
	                    }
	                    // This pair of players are done for this round.
	                    $players_done[] = $player;
	                    $players_done[] = $opponent;
	                }
	            }
	        }

	        // Match the last player
	        if ($round % 2 == 0) {
	            $opponent = ($round + $num_players) / 2;
	            if ($participants[$num_players]->id > 0 && $participants[$opponent]->id > 0) {

				   	$match = new SeasonCompetitionPhaseGroupLeagueDayMatch;
				   	$match->day_id = $day->id;
				   	$match->local_id = $participants[$num_players]->id;
				   	$match->local_user_id = $participants[$num_players]->participant->user->id;
				   	$match->visitor_id = $participants[$opponent]->id;
				   	$match->visitor_user_id = $participants[$opponent]->participant->user->id;
				   	$match->save();
	            }
	        } else {
	            $opponent = ($round + 1) / 2;
				if ($participants[$opponent]->id > 0 && $participants[$num_players]->id > 0) {
				   	$match = new SeasonCompetitionPhaseGroupLeagueDayMatch;
				   	$match->day_id = $day->id;
				   	$match->local_id = $participants[$opponent]->id;
				   	$match->local_user_id = $participants[$opponent]->participant->user->id;
				   	$match->visitor_id = $participants[$num_players]->id;
				   	$match->visitor_user_id = $participants[$num_players]->participant->user->id;
				   	$match->save();
				}
	        }
	        $next_day++;
	    }

		// we created the days and matches of the second round
	    if ($second_round) {
	    	if ($inverse_order) {
		    	for ($i=(count($day_to_repeat)); $i > 0; $i --) {
		    		$copy_day = SeasonCompetitionPhaseGroupLeagueDay::find($day_to_repeat[$i]);

					// first we create the new day
		    		$day = new SeasonCompetitionPhaseGroupLeagueDay;
		    		$day->league_id = $league_id;
		    		$day->order = $next_day;
		    		$day->save();

					// now we create the matches of the day going through the matches of the day of the first round
		    		foreach ($copy_day->matches as $copy_match) {
		    			$match = new SeasonCompetitionPhaseGroupLeagueDayMatch;
		    			$match->day_id = $day->id;
		    			$match->local_id = $copy_match->visitor_id;
		    			$match->local_user_id = $copy_match->visitor_user_id;
		    			$match->visitor_id = $copy_match->local_id;
		    			$match->visitor_user_id = $copy_match->local_user_id;
		    			$match->save();
		    		}
		    		$next_day++;
		    	}
	    	} else {
		    	for ($i=1; $i < (count($day_to_repeat)+1); $i ++) {
		    		$copy_day = SeasonCompetitionPhaseGroupLeagueDay::find($day_to_repeat[$i]);

					// first we create the new day
		    		$day = new SeasonCompetitionPhaseGroupLeagueDay;
		    		$day->league_id = $league_id;
		    		$day->order = $next_day;
		    		$day->save();

					// now we create the matches of the day going through the matches of the day of the first round
		    		foreach ($copy_day->matches as $copy_match) {
		    			$match = new SeasonCompetitionPhaseGroupLeagueDayMatch;
		    			$match->day_id = $day->id;
		    			$match->local_id = $copy_match->visitor_id;
		    			$match->local_user_id = $copy_match->visitor_user_id;
		    			$match->visitor_id = $copy_match->local_id;
		    			$match->visitor_user_id = $copy_match->local_user_id;
		    			$match->save();
		    		}
		    		$next_day++;
		    	}
	    	}
	    }
    }

    protected function get_table_data_participant($league_id, $participant_id)
    {

        $matches = SeasonCompetitionPhaseGroupLeagueDay::select('season_competitions_phases_groups_leagues_days.*', 'season_competitions_phases_groups_leagues_days_matches.*')
        	->join('season_competitions_phases_groups_leagues_days_matches', 'season_competitions_phases_groups_leagues_days_matches.day_id', '=', 'season_competitions_phases_groups_leagues_days.id')
        	->where('season_competitions_phases_groups_leagues_days_matches.local_id', '=', $participant_id)
        	->orwhere('season_competitions_phases_groups_leagues_days_matches.visitor_id', '=', $participant_id)
	        ->get();

	    $data = [
	    	"pj" => 0,
	    	"pg" => 0,
	    	"pe" => 0,
	    	"pp" => 0,
	    	"ps" => 0,
	    	"gf" => 0,
	    	"gc" => 0,
	    	"avg" => 0,
	    	"pts" => 0
	    ];

	    foreach ($matches as $match) {
	    	$league = SeasonCompetitionPhaseGroupLeague::find($match->league_id);
	    	if (!is_null($match->local_score) && !is_null($match->visitor_score))
	    	{
	    		$data['pj'] = $data['pj'] + 1;

		    	if ($participant_id == $match->local_id) { //local
		    		if ($match->local_score > $match->visitor_score) {
						$data['pg'] = $data['pg'] + 1;
						$data['pts'] = $data['pts'] + intval($league->win_points);
		    		} elseif ($match->local_score == $match->visitor_score) {
		    			$data['pe'] = $data['pe'] + 1;
		    			$data['pts'] = $data['pts'] + intval($league->draw_points);
		    		} else {
		    			$data['pp'] = $data['pp'] + 1;
		    			$data['pts'] = $data['pts'] + intval($league->lose_points);
		    		}
		    		$data['gf'] = $data['gf'] + $match->local_score;
		    		$data['gc'] = $data['gc'] + $match->visitor_score;

		    	} else { //visitor
		    		if ($match->visitor_score > $match->local_score) {
						$data['pg'] = $data['pg'] + 1;
						$data['pts'] = $data['pts'] + intval($league->win_points);
		    		} elseif ($match->local_score == $match->visitor_score) {
		    			$data['pe'] = $data['pe'] + 1;
		    			$data['pts'] = $data['pts'] + intval($league->draw_points);
		    		} else {
		    			$data['pp'] = $data['pp'] + 1;
		    			$data['pts'] = $data['pts'] + intval($league->lose_points);
		    		}
					$data['gf'] = $data['gf'] + $match->visitor_score;
		    		$data['gc'] = $data['gc'] + $match->local_score;
		    	}

		    	if ($match->sanctioned_id && ($participant_id == $match->sanctioned_id )) {
					$data['ps'] = $data['ps'] + 1;
		    	}


	    	}
	    }
	    $data['avg'] = $data['gf'] - $data['gc'];
	    return $data;
    }

}
