<?php

namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;

use Illuminate\Http\Request;
use App\SeasonCompetition;
use App\SeasonCompetitionPhase;
use App\SeasonCompetitionPhaseGroup;
use App\SeasonCompetitionPhaseGroupLeague;
use App\SeasonCompetitionPhaseGroupLeagueDay;
use App\SeasonCompetitionPhaseGroupParticipant;
use App\SeasonCompetitionPhaseGroupLeagueTableZone;
use App\PlayOff;
use App\SeasonCompetitionMatch;
use App\SeasonPlayer;
use App\SeasonParticipant;
use App\LeagueStat;
use App\Post;
use App\SeasonParticipantCashHistory as Cash;

class CompetitionController extends Controller
{
    public function index()
    {
    	$competitions = SeasonCompetition::where('season_id', '=', active_season()->id)->orderBy('name', 'asc')->get();
        return view('competitions.index', compact('competitions'));
    }

    public function table($season_slug, $competition_slug, $phase_slug = null, $group_slug = null)
    {
    	$competition = SeasonCompetition::where('slug', '=', $competition_slug)->firstOrFail();
    	$competitions = SeasonCompetition::where('season_id', '=', active_season()->id)->orderBy('name', 'asc')->get();

		if ($competition->phases->count()>0) {
			$phase = SeasonCompetitionPhase::where('competition_id', '=', $competition->id)->firstOrFail();
			$game_mode = $this->check_game_mode($phase);
		} else {
			return back()->with('error', 'La competición está en fase de configuración');
		}

		if ($game_mode == 'league') { // league

			if ($phase->groups->count()>0) {
				if (!$group_slug) {
					$group = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->firstOrFail();
				} else {
					$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->first();
				}
				$league = $this->check_league($group);
			} else {
				return back()->with('error', 'La competición está en fase de configuración');
			}

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
	        return view('competitions.league.table', compact('group', 'league', 'table_participants', 'competitions', 'competition'));

		} else { // playoffs

			if ($phase->groups->count()>0) {
				if (!$group_slug) {
					$group = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->firstOrFail();
				} else {
					$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->first();
				}
				$playoff = $this->check_playoff($group);
			} else {
				return back()->with('error', 'La competición está en fase de configuración');
			}

	        return view('competitions.playoffs.table', compact('group', 'playoff', 'competitions', 'competition'));

		}
    }

    public function calendar($season_slug, $competition_slug, $phase_slug = null, $group_slug = null)
    {
    	$competition = SeasonCompetition::where('slug', '=', $competition_slug)->firstOrFail();
    	$competitions = SeasonCompetition::where('season_id', '=', active_season()->id)->orderBy('name', 'asc')->get();

		if ($competition->phases->count()>0) {
			$phase = SeasonCompetitionPhase::where('competition_id', '=', $competition->id)->firstOrFail();
			$game_mode = $this->check_game_mode($phase);
		} else {
			return back()->with('error', 'La competición está en fase de configuración');
		}

		if ($game_mode == 'league') { // league
			if ($phase->groups->count()>0) {
				if (!$group_slug) {
					$group = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->firstOrFail();
				} else {
					$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->first();
				}
				$league = $this->check_league($group);
			} else {
				return back()->with('error', 'La competición está en fase de configuración');
			}

	        // $league = $this->check_league($group);

	        return view('competitions.league.calendar', compact('group', 'league', 'competitions', 'competition'));
		} else { // playoffs
			if ($phase->groups->count()>0) {
				if (!$group_slug) {
					$group = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->firstOrFail();
				} else {
					$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->first();
				}
				$playoff = $this->check_playoff($group);
			} else {
				return back()->with('error', 'La competición está en fase de configuración');
			}

	        return view('competitions.playoffs.calendar', compact('group', 'playoff', 'competitions', 'competition'));
		}
    }

    public function stats($season_slug, $competition_slug, $phase_slug = null, $group_slug = null)
    {
    	$competition = SeasonCompetition::where('slug', '=', $competition_slug)->firstOrFail();
    	$competitions = SeasonCompetition::where('season_id', '=', active_season()->id)->orderBy('name', 'asc')->get();

		if ($competition->phases->count()>0) {
			$phase = SeasonCompetitionPhase::where('competition_id', '=', $competition->id)->firstOrFail();
		} else {
			return back()->with('error', 'La competición está en fase de configuración');
		}
		if ($phase->groups->count()>0) {
			if (!$group_slug) {
				$group = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->firstOrFail();
			} else {
				$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->first();
			}
			$league = $this->check_league($group);
		} else {
			return back()->with('error', 'La competición está en fase de configuración');
		}
        $league = $this->check_league($group);

		$stats_goals = LeagueStat::select('player_id', \DB::raw('SUM(goals) as goals'))
			->where('league_id', '=', $league->id)
			->whereNotNull('goals')
            ->groupBy('player_id')
            ->orderBy('goals', 'desc')
            ->get();
		$stats_assists = LeagueStat::select('player_id', \DB::raw('SUM(assists) as assists'))
			->where('league_id', '=', $league->id)
			->whereNotNull('assists')
            ->groupBy('player_id')
            ->orderBy('assists', 'desc')
            ->get();
		$stats_yellow_cards = LeagueStat::select('player_id', \DB::raw('SUM(yellow_cards) as yellow_cards'))
			->where('league_id', '=', $league->id)
			->whereNotNull('yellow_cards')
            ->groupBy('player_id')
            ->orderBy('yellow_cards', 'desc')
            ->get();
		$stats_red_cards = LeagueStat::select('player_id', \DB::raw('SUM(red_cards) as red_cards'))
			->where('league_id', '=', $league->id)
			->whereNotNull('red_cards')
            ->groupBy('player_id')
            ->orderBy('red_cards', 'desc')
            ->get();

        return view('competitions.league.stats', compact('stats_goals', 'stats_assists', 'stats_yellow_cards', 'stats_red_cards', 'group', 'league', 'competitions', 'competition'));
    }

    public function editMatch($season_slug, $competition_slug, $match_id)
    {
    	$competition = SeasonCompetition::where('slug', '=', $competition_slug)->firstOrFail();
        $match = SeasonCompetitionMatch::find($match_id);

        return view('competitions.league.calendar.match', compact('match', 'competition'))->render();
    }

    public function updateMatch($season_slug, $competition_slug, $match_id) {
        $match = SeasonCompetitionMatch::find($match_id);

        if ($match->local_score == null && $match->visitor_score == null) {
	        $match->local_score = request()->local_score;
	        $match->visitor_score = request()->visitor_score;
	        $match->user_update_result = auth()->user()->id;
	        $match->date_update_result = now();
	        $match->save();

	        if ($match->day->league->has_stats()) {
	    		$local_players = SeasonPlayer::where('participant_id', '=', $match->local_participant->participant->id)->get();
	    		foreach ($local_players as $player) {
	    			if ($match->day->league->stats_goals) {
	        			$goals = request()->{"stats_goals_".$player->id};
	        		} else {
	                    $goals = 0;
	                }
	    			if ($match->day->league->stats_assists) {
	        			$assists = request()->{"stats_assists_".$player->id};
	                } else {
	                    $assists = 0;
	                }
	    			if ($match->day->league->stats_yellow_cards) {
	        			$yellow_cards = request()->{"stats_yellow_cards_".$player->id};
	                } else {
	                    $yellow_cards = 0;
	                }
	    			if ($match->day->league->stats_red_cards) {
	        			$red_cards = request()->{"stats_red_cards_".$player->id};
	                } else {
	                    $red_cards = 0;
	                }
	    			if ($goals > 0 || $assists > 0 || $yellow_cards > 0 || $red_cards > 0) {
	    				$stat = new LeagueStat;
	    				$stat->match_id = $match->id;
	    				$stat->day_id = $match->day->id;
	    				$stat->league_id = $match->day->league->id;
	    				$stat->player_id = $player->id;
	    				if ($goals > 0) { $stat->goals = $goals; }
	    				if ($assists > 0) { $stat->assists = $assists; }
	    				if ($yellow_cards > 0) { $stat->yellow_cards = $yellow_cards; }
	    				if ($red_cards > 0) { $stat->red_cards = $red_cards; }
	    				$stat->save();
	    			}
	    		}

	    		$visitor_players = SeasonPlayer::where('participant_id', '=', $match->visitor_participant->participant->id)->get();
	    		foreach ($visitor_players as $player) {
	    			if ($match->day->league->stats_goals) {
	        			$goals = request()->{"stats_goals_".$player->id};
	                } else {
	                    $goals = 0;
	                }
	    			if ($match->day->league->stats_assists) {
	        			$assists = request()->{"stats_assists_".$player->id};
	                } else {
	                    $assists = 0;
	                }
	    			if ($match->day->league->stats_yellow_cards) {
	        			$yellow_cards = request()->{"stats_yellow_cards_".$player->id};
	                } else {
	                    $yellow_cards = 0;
	                }
	    			if ($match->day->league->stats_red_cards) {
	        			$red_cards = request()->{"stats_red_cards_".$player->id};
	                } else {
	                    $red_cards = 0;
	                }
	    			if ($goals > 0 || $assists > 0 || $yellow_cards > 0 || $red_cards > 0) {
	    				$stat = new LeagueStat;
	    				$stat->match_id = $match->id;
	    				$stat->day_id = $match->day->id;
	    				$stat->league_id = $match->day->league->id;
	    				$stat->player_id = $player->id;
	    				if ($goals > 0) { $stat->goals = $goals; }
	    				if ($assists > 0) { $stat->assists = $assists; }
	    				if ($yellow_cards > 0) { $stat->yellow_cards = $yellow_cards; }
	    				if ($red_cards > 0) { $stat->red_cards = $red_cards; }
	    				$stat->save();
	    			}
	    		}
	        }

	        // economy
        	$this->add_cash_history(
        		$match->local_participant->participant->id,
        		'Partido jugado, ' . $match->match_name(),
        		$match->day->league->play_amount,
        		'E'
        	);
        	$this->add_cash_history(
        		$match->visitor_participant->participant->id,
        		'Partido jugado, ' . $match->match_name(),
        		$match->day->league->play_amount,
        		'E'
        	);

	        $match_limit = new \Carbon\Carbon($match->date_limit);
	        $date_update_result = new \Carbon\Carbon($match->date_update_result);
			if ($match_limit > $date_update_result) {
				$play_in_limit = true;
			} else {
				$play_in_limit = false;
			}

	        if ($play_in_limit) {
	        	$this->add_cash_history(
	        		$match->local_participant->participant->id,
	        		'Partido jugado en plazo, ' . $match->match_name(),
	        		$match->day->league->play_ontime_amount,
	        		'E'
	        	);
	        	$this->add_cash_history(
	        		$match->visitor_participant->participant->id,
	        		'Partido jugado en plazo, ' . $match->match_name(),
	        		$match->day->league->play_ontime_amount,
	        		'E'
	        	);
	        }

        	if ($match->local_score > $match->visitor_score) {
				$local_points = $match->day->league->win_amount;
				$visitor_points = $match->day->league->lose_amount;
				$local_result = "victoria";
				$visitor_result = "derrota";
        	} elseif ($match->local_score < $match->visitor_score) {
				$local_points = $match->day->league->lose_amount;
				$visitor_points = $match->day->league->win_amount;
				$local_result = "derrota";
				$visitor_result = "victoria";
        	} else { // draw
				$local_points = $match->day->league->draw_amount;
				$visitor_points = $match->day->league->draw_amount;
				$local_result = "empate";
				$visitor_result = "empate";
        	}
        	if ($local_points > 0) {
	        	$this->add_cash_history(
	        		$match->local_participant->participant->id,
	        		'Puntos obtenidos (' . $local_result . ') en partido, ' . $match->match_name(),
	        		$local_points,
	        		'E'
	        	);
        	}
        	if ($visitor_points > 0) {
	        	$this->add_cash_history(
	        		$match->visitor_participant->participant->id,
	        		'Puntos obtenidos (' . $visitor_result . ') en partido, ' . $match->match_name(),
	        		$visitor_points,
	        		'E'
	        	);
        	}

	        // telegram notification
	        $competition = $match->day->league->group->phase->competition->name;
			$team_local = $match->local_participant->participant->name();
			$team_local_slug = $match->local_participant->participant->team->slug;
			$team_local_budget = $match->local_participant->participant->budget();
			$user_local = $match->local_participant->participant->sub_name();
			$team_visitor = $match->visitor_participant->participant->name();
			$team_visitor_slug = $match->visitor_participant->participant->team->slug;
			$team_visitor_budget = $match->visitor_participant->participant->budget();
			$user_visitor = $match->visitor_participant->participant->sub_name();
			$score = $match->local_score . '-' . $match->visitor_score;
			$local_amount = $match->day->league->play_amount + $local_points;
			if ($play_in_limit) {
				$local_amount += $match->day->league->play_ontime_amount;
			}
			$visitor_amount = $match->day->league->play_amount + $visitor_points;
			if ($play_in_limit) {
				$visitor_amount += $match->day->league->play_ontime_amount;
			}
	    	$local_economy = "    \xF0\x9F\x92\xB0" . $team_local . " (" . $user_local . ") <b>ingresa</b> " . number_format($local_amount, 2, ",", ".") . " mill.\n";
			$local_club_link = 'https://lpx.es/clubs/' . $team_local_slug . '/economia';
	    	$local_economy_link = "    <a href='$local_club_link'>Historial de economia</a>\n\n";

	    	$visitor_economy = "    \xF0\x9F\x92\xB0" . $team_visitor . " (" . $user_visitor . ") <b>ingresa</b> " . number_format($visitor_amount, 2, ",", ".") . " mill.\n";
			$visitor_club_link = 'https://lpx.es/clubs/' . $team_visitor_slug . '/economia';
	    	$visitor_economy_link = "    <a href='$visitor_club_link'>Historial de economia</a>\n\n\n";

			$table_link = 'https://lpx.es/competiciones/' . $season_slug . '/' . $competition_slug . '/clasificacion';
			$calendar_link = 'https://lpx.es/competiciones/' . $season_slug . '/' . $competition_slug . '/partidos';
			$title = "\xE2\x9A\xBD Partido jugado \xF0\x9F\x8E\xAE" . ' - ' . $match->match_name();

			$text = "$title\n\n";
			$text .= "    <b>$team_local $score $team_visitor</b>\n\n\n";
			$text .= $local_economy;
			$text .= $local_economy_link;
			$text .= $visitor_economy;
			$text .= $visitor_economy_link;
			$text .= "\xF0\x9F\x93\x85 <a href='$calendar_link'>Calendario $competition</a>\n";
			$text .= "\xF0\x9F\x93\x8A <a href='$table_link'>Clasificación $competition</a>\n";

			// Telegram::sendMessage([
			//     'chat_id' => '-1001241759649',
			//     'parse_mode' => 'HTML',
			//     'text' => $text
			// ]);

	        // generate new (post)
	        $post = Post::create([
			    'type' => 'result',
			    'transfer_id' => null,
			    'match_id' => $match_id,
			    'category' => $match->match_name(),
			    'title' => "$team_local $score $team_visitor",
			    'description' => null,
			    'img' => $match->day->league->group->phase->competition->img,
	        ]);

	        return back()->with('success', 'Resultado registrado correctamente.');
	    } else {
	    	return back()->with('error', 'El resultado ya está registrado, contacta con los administradores si algún dato no es correcto.');
	    }
    }

    public function matchDetails($season_slug, $competition_slug, $match_id) {
        $match = SeasonCompetitionMatch::find($match_id);

        return view('competitions.league.calendar.match_details', compact('match'))->render();
    }

    public function pendingMatches()
    {
    	return back()->with('info', 'Partidas pendientes - Próximamente...');
    }




    ///helpers

    protected function check_league($group)
    {
        $league = SeasonCompetitionPhaseGroupLeague::where('group_id', '=', $group->id)->get()->first();

        if (!$league) {
        	$league = new SeasonCompetitionPhaseGroupLeague;
        	$league->group_id = $group->id;
        	$league->save();
        	// $league = SeasonCompetitionPhaseGroupLeague::where('group_id', '=', $group->id)->get()->first();
        }

        return $league;
    }

    protected function check_playoff($group)
    {
        $playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();

        if (!$playoff) {
        	$playoff = new PlayOff;
        	$playoff->group_id = $group->id;
        	$playoff->save();
        	// $playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();
        }

        return $playoff;
    }

	protected function get_table_data_participant($league_id, $participant_id)
    {

        $matches = SeasonCompetitionPhaseGroupLeagueDay::select('season_competitions_phases_groups_leagues_days.*', 'season_competitions_matches.*')
        	->join('season_competitions_matches', 'season_competitions_matches.day_id', '=', 'season_competitions_phases_groups_leagues_days.id')
        	->where('season_competitions_matches.local_id', '=', $participant_id)
        	->orwhere('season_competitions_matches.visitor_id', '=', $participant_id)
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

	protected function add_cash_history($participant_id, $description, $amount, $movement)
	{
	    $cash = new Cash;
	    $cash->participant_id = $participant_id;
	    $cash->description = $description;
	    $cash->amount = $amount;
	    $cash->movement = $movement;
	    $cash->save();

	    if ($cash->save()) {
	    	$participant = SeasonParticipant::find($participant_id);
	    	if ($movement == 'E') {
	    		$action = 'ingresa';
	    	} else {
	    		$action = 'desembolsa';
	    	}

	        // telegram notification
			// $club_link = 'https://lpx.es/clubs/' . $participant->team->slug . '/economia';
	  //   	$text = "\xF0\x9F\x92\xB0" . $participant->team->name . " (" . $participant->user->name . ") <b>" . $action . "</b> " . number_format($amount, 2, ",", ".") . " mill.\n";
	  //   	$text .= "    Concepto: " . $description . "\n\n";
	  //   	$text .= "    Presupuesto " . $participant->team->name . ": " . number_format($participant->budget(), 2, ",", ".") . " mill.\n\n";
	  //   	$text .= "\xF0\x9F\x92\xB8 <a href='$club_link'>Historial de economia de " . $participant->team->name . "</a>";
			// Telegram::sendMessage([
			//     'chat_id' => '-1001241759649',
			//     'parse_mode' => 'HTML',
			//     'text' => $text
			// ]);
	    }
	}

	protected function check_game_mode($phase)
	{
		return $phase->mode;
	}

}
