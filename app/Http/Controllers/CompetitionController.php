<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonCompetition;
use App\SeasonCompetitionPhase;
use App\SeasonCompetitionPhaseGroup;
use App\SeasonCompetitionPhaseGroupLeague;
use App\SeasonCompetitionPhaseGroupLeagueDay;
use App\SeasonCompetitionPhaseGroupParticipant;
use App\SeasonCompetitionPhaseGroupLeagueTableZone;
use App\SeasonCompetitionMatch;
use App\SeasonPlayer;
use App\LeagueStat;

class CompetitionController extends Controller
{
    public function index()
    {
    	// return back()->with('info', 'Competiciones - Próximamente...');

    	$competitions = SeasonCompetition::where('season_id', '=', active_season()->id)->orderBy('name', 'asc')->get();
        return view('competition.competitions', compact('competitions'));
    }

    public function pendingMatches()
    {
    	return back()->with('info', 'Partidas pendientes - Próximamente...');
    }

    public function table($season_slug, $competition_slug)
    {
    	$competition = SeasonCompetition::where('slug', '=', $competition_slug)->firstOrFail();
    	$competitions = SeasonCompetition::where('season_id', '=', active_season()->id)->orderBy('name', 'asc')->get();

		if ($competition->phases->count()>0) {
			$phase = SeasonCompetitionPhase::where('competition_id', '=', $competition->id)->firstOrFail();
		} else {
			return back()->with('error', 'La competición está en fase de configuración');
		}
		if ($phase->groups->count()>0) {
			$group = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->firstOrFail();
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

        return view('competition.competition.table', compact('group', 'league', 'table_participants', 'competitions', 'competition'));
    }

    public function calendar($season_slug, $competition_slug)
    {
    	$competition = SeasonCompetition::where('slug', '=', $competition_slug)->firstOrFail();
    	$competitions = SeasonCompetition::where('season_id', '=', active_season()->id)->orderBy('name', 'asc')->get();

		if ($competition->phases->count()>0) {
			$phase = SeasonCompetitionPhase::where('competition_id', '=', $competition->id)->firstOrFail();
		} else {
			return back()->with('error', 'La competición está en fase de configuración');
		}
		if ($phase->groups->count()>0) {
			$group = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->firstOrFail();
			$league = $this->check_league($group);
		} else {
			return back()->with('error', 'La competición está en fase de configuración');
		}

        $league = $this->check_league($group);

        return view('competition.competition.calendar', compact('group', 'league', 'competitions', 'competition'));
    }

    public function editMatch($season_slug, $competition_slug, $match_id)
    {
    	$competition = SeasonCompetition::where('slug', '=', $competition_slug)->firstOrFail();
        $match = SeasonCompetitionMatch::find($match_id);

        return view('competition.competition.calendar.match', compact('match', 'competition'))->render();
    }

    public function updateMatch($season_slug, $competition_slug, $match_id) {
        $match = SeasonCompetitionMatch::find($match_id);

        $match->local_score = request()->local_score;
        $match->visitor_score = request()->visitor_score;
        if (request()->sanctioned_id > 0) {
        	$match->sanctioned_id = request()->sanctioned_id;
        }
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

        return back()->with('success', 'Resultado registrado correctamente.');
    }



    ///helpers

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

}
