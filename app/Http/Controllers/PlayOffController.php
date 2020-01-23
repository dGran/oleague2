<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\PlayOff;
use App\PlayOffStat;
use App\PlayOffRound;
use App\PlayOffRoundClash;
use App\PlayOffRoundParticipant;
use App\SeasonCompetitionMatch;
use App\SeasonCompetitionPhaseGroup;
use App\SeasonCompetitionPhaseGroupParticipant;
use App\SeasonParticipant;
use App\SeasonParticipantCashHistory as Cash;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;


class PlayOffController extends Controller
{
    public function index($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $playoff = $this->check_playoff($group);
        // $playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();
        // dd($playoff);

        return view('admin.seasons_competitions_phases_groups_playoffs.index', compact('group', 'playoff'));
    }

    public function update($id) {
    	$playoff = PlayOff::find($id);
    	$playoff->predefined_rounds = request()->predefined_rounds;
    	$playoff->stats_mvp = request()->stats_mvp ? 1 : 0;
    	$playoff->stats_goals = request()->stats_goals ? 1 : 0;
    	$playoff->stats_assists = request()->stats_assists ? 1 : 0;
    	$playoff->stats_yellow_cards = request()->stats_yellow_cards ? 1 : 0;
    	$playoff->stats_red_cards = request()->stats_red_cards ? 1 : 0;
    	$playoff->save();

    	return back()->with('success', 'Configuración del playoff actualizada correctamente');
    }

    public function roundUpdate($round_id) {
    	$round = PlayOffRound::find($round_id);
    	$round->name = request()->name;
    	$round->round_trip = request()->playoff_type == 0 ? 0 : 1;
		$round->double_value = request()->playoff_type == 2 ? 1 : 0;
    	$round->date_limit = request()->date_limit;
    	$round->play_amount = request()->play_amount;
    	$round->play_ontime_amount = request()->play_ontime_amount;
    	$round->win_amount = request()->win_amount;
    	$round->save();

    	foreach ($round->clashes as $clash) {
    		$clash->date_limit = $round->date_limit;
    		$clash->save();
    		foreach ($clash->matches as $match) {
    			$match->date_limit = $clash->date_limit;
    			$match->save();
    		}
    	}

    	return back()->with('success', 'Configuración de ronda "' . $round->name . '" actualizada correctamente');
    }

    public function generate_rounds($playoff_id, $rounds)
    {
    	$playoff = PlayOff::find($playoff_id);

    	if ($rounds == 0) {
	        $participants = $playoff->group->participants->count();
	        $rounds = 1;
	        while ($participants > 2) {
	        	$rounds++;
	        	$participants = intval($participants / 2);
	        }
	    }

        $playoff->num_rounds = $rounds;
        $playoff->save();

		for ($i=1; $i < $rounds+1; $i++) {
			$round = new PlayOffRound;
			$round->playoff_id = $playoff->id;
			$round->name = "Ronda " . $i;
			$round->save();

			if ($i == 1) { // copy participants for round 1
				foreach ($playoff->group->participants as $group_participant) {
					$round_participant = new PlayOffRoundParticipant;
					$round_participant->round_id = $round->id;
					$round_participant->participant_id = $group_participant->id;
					$round_participant->save();
				}
			}

            // generate empty_clashes
            // $round_participants = PlayOffRoundParticipant::where('round_id', '=', $round->id)->inRandomOrder()->get();
            // for ($i=0; $i < ($round_participants->count() / 2); $i++) {
            //     $clash = new PlayOffRoundClash;
            //     $clash->round_id = $round->id;
            //     $clash->order = $i + 1;
            //     $clash->local_id = null;
            //     $clash->visitor_id = null;
            //     $clash->save();
            // }
		}

		return back()->with('success', 'Se han generado las rondas correctamente');
    }

    public function reset_rounds($playoff_id)
    {
    	$playoff = PlayOff::find($playoff_id);

    	foreach ($playoff->rounds as $round) {
    		foreach ($round->clashes as $clash) {
    			foreach ($clash->matches as $match) {
    				$match->delete();
    			}
    			$clash->delete();
    		}
    		foreach ($round->participants as $participant) {
    			$participant->delete();
    		}
    		$round->delete();
    	}

		return back()->with('success', 'Se han eliminado todas las rondas y sus emparejamientos correctamente');
    }


    public function rounds($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();

        return view('admin.seasons_competitions_phases_groups_playoffs.rounds', compact('group', 'playoff'));
    }


    public function generate_clashes($round_id)
    {
    	$round = PlayOffRound::findOrFail($round_id);
		foreach ($round->clashes as $clash) {
			foreach ($clash->matches as $match) {
				$match->delete();
			}
			$clash->delete();
		}

		$round_participants = PlayOffRoundParticipant::where('round_id', '=', $round->id)->inRandomOrder()->get();
		$part = 0;
		for ($i=0; $i < ($round_participants->count() / 2); $i++) {
			$clash = new PlayOffRoundClash;
			$clash->round_id = $round->id;
			$clash->order = $i + 1;
			$clash->local_id = $round_participants[$part]->participant_id;
			$part++;
			$clash->visitor_id = $round_participants[$part]->participant_id;
			$clash->save();
			$part++;

			$this->generate_matches($clash);
		}

		return back()->with('success', 'Emparejamientos sorteados correctamente');
    }

    public function generate_empty_clashes($round_id)
    {
    	$round = PlayOffRound::findOrFail($round_id);
		foreach ($round->clashes as $clash) {
			foreach ($clash->matches as $match) {
				$match->delete();
			}
			$clash->delete();
		}

		$round_participants = PlayOffRoundParticipant::where('round_id', '=', $round->id)->inRandomOrder()->get();
		for ($i=0; $i < ($round_participants->count() / 2); $i++) {
			$clash = new PlayOffRoundClash;
			$clash->round_id = $round->id;
			$clash->order = $i + 1;
			$clash->local_id = null;
			$clash->visitor_id = null;
			$clash->save();
		}

		// if ($round->round_trip) {
		// 	$clashes = PlayOffRoundClash::where('round_id', '=', $round->id)->get();
		// 	foreach ($clashes as $clash) {
		// 		$second_clash = new PlayOffRoundClash;
		// 		$second_clash->round_id = $round->id;
		// 		$second_clash->order = $clash->order;
		// 		$second_clash->local_id = $clash->visitor_id;
		// 		$second_clash->visitor_id = $clash->local_id;
		// 		$second_clash->return_match = 1;
		// 		$second_clash->save();
		// 		$part++;
		// 	}
		// }

		return back()->with('success', 'Emparejamientos generados correctamente');
	}

	public function restore_clashes($round_id)
	{
    	$round = PlayOffRound::findOrFail($round_id);
		foreach ($round->clashes as $clash) {
			foreach ($clash->matches as $match) {
				$match->delete();
			}
			$clash->delete();
		}
		return back()->with('success', 'Los emparejamientos de la ronda se han restaurado correctamente');
	}

	public function assing_local_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$round_id = $clash->round->id;

        $round_participants = PlayOffRoundParticipant::select('*')
        		->where('round_id', '=', $round_id)
                ->whereNotIn('participant_id', function($query) use ($round_id) {
                   $query->select('local_id')->from('playoffs_rounds_clashes')->whereNotNull('local_id')->where('round_id', '=', $round_id);
                })
                ->whereNotIn('participant_id', function($query) use ($round_id) {
                   $query->select('visitor_id')->from('playoffs_rounds_clashes')->whereNotNull('visitor_id')->where('round_id', '=', $round_id);
                })
                ->get();

        return view('admin.seasons_competitions_phases_groups_playoffs.rounds.assing_local_participant', compact('clash', 'round_participants'))->render();
	}

	public function update_assing_local_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$clash->local_id = request()->clash_participant;
		$clash->save();

		if ($clash->local_id && $clash->visitor_id) {
			$this->generate_matches($clash);
		}

		return back()->with('success', 'Participante local asignado al emparejamiento correctamente');
	}

	public function assing_visitor_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$round_id = $clash->round->id;

        $round_participants = PlayOffRoundParticipant::select('*')
        		->where('round_id', '=', $round_id)
                ->whereNotIn('participant_id', function($query) use ($round_id) {
                   $query->select('visitor_id')->from('playoffs_rounds_clashes')->whereNotNull('visitor_id')->where('round_id', '=', $round_id);
                })
                ->whereNotIn('participant_id', function($query) use ($round_id) {
                   $query->select('local_id')->from('playoffs_rounds_clashes')->whereNotNull('local_id')->where('round_id', '=', $round_id);
                })
                ->get();

        return view('admin.seasons_competitions_phases_groups_playoffs.rounds.assing_visitor_participant', compact('clash', 'round_participants'))->render();
	}

	public function update_assing_visitor_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$clash->visitor_id = request()->clash_participant;
		$clash->save();

		if ($clash->local_id && $clash->visitor_id) {
			$this->generate_matches($clash);
		}

		return back()->with('success', 'Participante visitante asignado al emparejamiento correctamente');
	}

	public function liberate_local_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$clash->local_id = NULL;
		$clash->save();

		foreach ($clash->matches as $match) {
			$match->delete();
		}

		return back()->with('success', 'Participante local eliminado correctamente');
	}

	public function liberate_visitor_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$clash->visitor_id = NULL;
		$clash->save();

		foreach ($clash->matches as $match) {
			$match->delete();
		}

		return back()->with('success', 'Participante visitante eliminado correctamente');
	}

	public function editMatch($match_id)
	{
        $match = SeasonCompetitionMatch::find($match_id);
    	$group = $match->clash->round->playoff->group;

        return view('admin.seasons_competitions_phases_groups_playoffs.rounds.match', compact('match', 'group'))->render();
	}

    public function updateMatch($match_id)
    {
        $match = SeasonCompetitionMatch::find($match_id);

        if ($match->local_score == null && $match->visitor_score == null) {
            $match->local_score = request()->local_score;
            $match->visitor_score = request()->visitor_score;
            $match->user_update_result = auth()->user()->id;
            $match->date_update_result = now();
            if (request()->sanctioned_id > 0) {
                $match->sanctioned_id = request()->sanctioned_id;
            }
            $match->save();

            if ($match->clash->round->playoff->has_stats()) {
                $local_players = SeasonPlayer::where('participant_id', '=', $match->local_participant->participant->id)->get();
                foreach ($local_players as $player) {
                    if ($match->clash->round->playoff->stats_goals) {
                        $goals = request()->{"stats_goals_".$player->id};
                    } else {
                        $goals = 0;
                    }
                    if ($match->clash->round->playoff->stats_assists) {
                        $assists = request()->{"stats_assists_".$player->id};
                    } else {
                        $assists = 0;
                    }
                    if ($match->clash->round->playoff->stats_yellow_cards) {
                        $yellow_cards = request()->{"stats_yellow_cards_".$player->id};
                    } else {
                        $yellow_cards = 0;
                    }
                    if ($match->clash->round->playoff->stats_red_cards) {
                        $red_cards = request()->{"stats_red_cards_".$player->id};
                    } else {
                        $red_cards = 0;
                    }
                    if ($goals > 0 || $assists > 0 || $yellow_cards > 0 || $red_cards > 0) {
                        $stat = new PlayOffStat;
                        $stat->match_id = $match->id;
                        $stat->clash_id = $match->clash->id;
                        $stat->playoff_id = $match->clash->round->playoff->id;
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
                    if ($match->clash->round->playoff->stats_goals) {
                        $goals = request()->{"stats_goals_".$player->id};
                    } else {
                        $goals = 0;
                    }
                    if ($match->clash->round->playoff->stats_assists) {
                        $assists = request()->{"stats_assists_".$player->id};
                    } else {
                        $assists = 0;
                    }
                    if ($match->clash->round->playoff->stats_yellow_cards) {
                        $yellow_cards = request()->{"stats_yellow_cards_".$player->id};
                    } else {
                        $yellow_cards = 0;
                    }
                    if ($match->clash->round->playoff->stats_red_cards) {
                        $red_cards = request()->{"stats_red_cards_".$player->id};
                    } else {
                        $red_cards = 0;
                    }
                    if ($goals > 0 || $assists > 0 || $yellow_cards > 0 || $red_cards > 0) {
                        $stat = new PlayOffStat;
                        $stat->match_id = $match->id;
                        $stat->clash_id = $match->clash->id;
                        $stat->playoff_id = $match->clash->round->playoff->id;
                        $stat->player_id = $player->id;
                        if ($goals > 0) { $stat->goals = $goals; }
                        if ($assists > 0) { $stat->assists = $assists; }
                        if ($yellow_cards > 0) { $stat->yellow_cards = $yellow_cards; }
                        if ($red_cards > 0) { $stat->red_cards = $red_cards; }
                        $stat->save();
                    }
                }
            }

            if ((!$match->clash->round->round_trip) || ($match->clash->round->round_trip && $match->order == 2)) {
	            // economy
	            if ($match->clash->winner() == $match->local_id) {
	            	$local_amount = $match->clash->round->play_amount + $match->clash->round->win_amount;
	            	$visitor_amount = $match->clash->round->play_amount;
	            } else {
	            	$local_amount = $match->clash->round->play_amount;
	            	$visitor_amount = $match->clash->round->play_amount + $match->clash->round->win_amount;
	            }

	            if ($match->local_id != $match->sanctioned_id) {
	                $this->add_cash_history(
	                    $match->local_participant->participant->id,
	                    'Partido jugado, ' . $match->match_name(),
	                    $local_amount,
	                    'E'
	                );
	            }
	            if ($match->visitor_id != $match->sanctioned_id) {
	                $this->add_cash_history(
	                    $match->visitor_participant->participant->id,
	                    'Partido jugado, ' . $match->match_name(),
	                    $visitor_amount,
	                    'E'
	                );
	            }

	            if ($match->clash->round->play_ontime_amount > 0)
	            {
		            if ($match->sanctioned_id == 0) {
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
		                        $match->clash->round->play_ontime_amount,
		                        'E'
		                    );
		                    $this->add_cash_history(
		                        $match->visitor_participant->participant->id,
		                        'Partido jugado en plazo, ' . $match->match_name(),
		                        $match->clash->round->play_ontime_amount,
		                        'E'
		                    );
		                }
		            } else {
		                if ($match->local_id != $match->sanctioned_id) {
		                    $this->add_cash_history(
		                        $match->local_participant->participant->id,
		                        'Partido jugado en plazo, ' . $match->match_name(),
		                        $match->clash->round->play_ontime_amount,
		                        'E'
		                    );
		                }
		                if ($match->visitor_id != $match->sanctioned_id) {
		                    $this->add_cash_history(
		                        $match->visitor_participant->participant->id,
		                        'Partido jugado en plazo, ' . $match->match_name(),
		                        $match->clash->round->play_ontime_amount,
		                        'E'
		                    );
		                }
		            }
	            }

            }

            // telegram notification
            // $competition = $match->clash->round->playoff->group->phase->competition->name;
            // $competition_slug = $match->clash->round->playoff->group->phase->competition->slug;
            // $season_slug = $match->clash->round->playoff->group->phase->competition->season->slug;
            $team_local = $match->local_participant->participant->name();
            // $team_local_slug = $match->local_participant->participant->team->slug;
            // $team_local_budget = $match->local_participant->participant->budget();
            // $user_local = $match->local_participant->participant->sub_name();
            $team_visitor = $match->visitor_participant->participant->name();
            // $team_visitor_slug = $match->visitor_participant->participant->team->slug;
            // $team_visitor_budget = $match->visitor_participant->participant->budget();
            // $user_visitor = $match->visitor_participant->participant->sub_name();
            $score = $match->local_score . '-' . $match->visitor_score;
            // if ($match->sanctioned_id == 0) {
            //     $local_amount = $match->clash->round->play_amount + $match->clash->round->win_amount;
            //     if ($play_in_limit) {
            //         $local_amount += $match->clash->round->play_ontime_amount;
            //     }
            //     $visitor_amount = $match->clash->round->playoff->play_amount + $visitor_points;
            //     if ($play_in_limit) {
            //         $visitor_amount += $match->clash->round->playoff->play_ontime_amount;
            //     }
            // } else {
            //     if ($match->local_id == $match->sanctioned_id) {
            //         $local_amount = 0;
            //         $visitor_amount = $match->clash->round->playoff->play_amount + $visitor_points + $match->clash->round->playoff->play_ontime_amount;
            //     } else {
            //         $local_amount = $match->clash->round->playoff->play_amount + $local_points + $match->clash->round->playoff->play_ontime_amount;
            //         $visitor_amount = 0;
            //     }
            // }
            // $local_economy = "    \xF0\x9F\x92\xB0" . $team_local . " (" . $user_local . ") <b>ingresa</b> " . number_format($local_amount, 2, ",", ".") . " mill.\n";
            // $local_club_link = 'https://lpx.es/clubs/' . $team_local_slug . '/economia';
            // $local_economy_link = "    <a href='$local_club_link'>Historial de economia</a>\n\n";

            // $visitor_economy = "    \xF0\x9F\x92\xB0" . $team_visitor . " (" . $user_visitor . ") <b>ingresa</b> " . number_format($visitor_amount, 2, ",", ".") . " mill.\n";
            // $visitor_club_link = 'https://lpx.es/clubs/' . $team_visitor_slug . '/economia';
            // $visitor_economy_link = "    <a href='$visitor_club_link'>Historial de economia</a>\n\n\n";

            // $table_link = 'https://lpx.es/competiciones/' . $season_slug . '/' . $competition_slug . '/clasificacion';
            // $calendar_link = 'https://lpx.es/competiciones/' . $season_slug . '/' . $competition_slug . '/partidos';
            // $title = "\xE2\x9A\xBD Partido jugado \xF0\x9F\x8E\xAE" . ' - ' . $match->match_name();

            // $text = "$title\n\n";
            // if ($match->sanctioned_id == 0) {
            //     $text .= "    <b>$team_local $score $team_visitor</b>\n\n\n";
            // } else {
            //     if ($match->local_id == $match->sanctioned_id) {
            //         $text .= "    <b>$team_local $score $team_visitor</b>\n";
            //         $text .= "    $team_local sancionado\n\n\n";
            //     } else {
            //         $text .= "    <b>$team_local $score $team_visitor</b>\n";
            //         $text .= "    $team_visitor sancionado\n\n\n";
            //     }
            // }
            // $text .= $local_economy;
            // $text .= $local_economy_link;
            // $text .= $visitor_economy;
            // $text .= $visitor_economy_link;
            // $text .= "\xF0\x9F\x93\x85 <a href='$calendar_link'>Calendario $competition</a>\n";
            // $text .= "\xF0\x9F\x93\x8A <a href='$table_link'>Clasificación $competition</a>\n";

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
                'img' => $match->clash->round->playoff->group->phase->competition->img,
            ]);

            return back()->with('success', 'Resultado registrado correctamente.');
        } else {
            return back()->with('error', 'El resultado ya está registrado.');
        }
    }






    // HELPER FUNCTIONS

    protected function check_playoff($group)
    {
        $playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();

        if (!$playoff) {
        	$playoff = new PlayOff;
        	$playoff->group_id = $group->id;
        	$playoff->save();
        	$playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();
        }

        // if ($playoff->rounds->count() == 0) {
        // 	if ($playoff->num_rounds == 0) {
        // 		$this->generate_rounds($playoff, null);
        // 	}
        // 	if ($playoff->num_rounds == 1) {
        // 		$this->generate_rounds($playoff, 1);
        // 	}
        // }

        return $playoff;
    }

    protected function generate_matches($clash)
    {
		$match = new SeasonCompetitionMatch;
		$match->clash_id = $clash->id;
		$match->order = 1;
		$match->local_id = $clash->local_id;
		$match->local_user_id = $clash->local_participant->participant->id;
		$match->visitor_id = $clash->visitor_id;
		$match->visitor_user_id = $clash->visitor_participant->participant->id;
		$match->save();

		if ($clash->round->round_trip) {
			$match = new SeasonCompetitionMatch;
			$match->clash_id = $clash->id;
			$match->order = 2;
			$match->local_id = $clash->visitor_id;
			$match->local_user_id = $clash->visitor_participant->participant->id;
			$match->visitor_id = $clash->local_id;
			$match->visitor_user_id = $clash->local_participant->participant->id;
			$match->save();
		}
    }

    protected function add_cash_history($participant_id, $description, $amount, $movement) {
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
        }
    }

}