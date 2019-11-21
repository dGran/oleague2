<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PlayOff;
use App\PlayOffRound;
use App\PlayOffRoundClash;
use App\PlayOffRoundParticipant;
use App\SeasonCompetitionPhaseGroup;
use App\SeasonCompetitionPhaseGroupParticipant;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;


class PlayOffController extends Controller
{
    public function index($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        // $playoff = $this->check_playoff($group);
        $playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();

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
		}

		return back()->with('success', 'Se han generado las rondas correctamente');
    }

    public function reset_rounds($playoff_id)
    {
    	$playoff = PlayOff::find($playoff_id);

    	foreach ($playoff->rounds as $round) {
    		foreach ($round->clashes as $clash) {
    			$clash->delete();
    		}
    		foreach ($round->participants as $participant) {
    			$participant->delete();
    		}
    		$round->delete();
    	}


    	//faltaria eliminar los partidos de las eliminatorias

		return back()->with('success', 'Se han eliminado todas las rondas y sus emparejamientos correctamente');
    }


    public function rounds($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $playoff = PlayOff::where('group_id', '=', $group->id)->get()->first();

        return view('admin.seasons_competitions_phases_groups_playoffs.rounds', compact('group', 'playoff'));
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

        if ($playoff->rounds->count() == 0) {
        	if ($playoff->num_rounds == 0) {
        		$this->generate_rounds($playoff, null);
        	}
        	if ($playoff->num_rounds == 1) {
        		$this->generate_rounds($playoff, 1);
        	}
        }

        return $playoff;
    }


    protected function generate_empty_clashes($round_id)
    {
    	$round = PlayOffRound::findOrFail($round_id);
		foreach ($round->clashes as $clash) {
			$clash->delete();
		}

		$round_participants = PlayOffRoundParticipant::where('round_id', '=', $round->id)->inRandomOrder()->get();
		$part = 0;
		for ($i=0; $i < ($round_participants->count() / 2); $i++) {
			$clash = new PlayOffRoundClash;
			$clash->round_id = $round->id;
			$clash->order = $i + 1;
			$clash->local_id = null;
			$part++;
			$clash->visitor_id = null;
			$clash->save();
			$part++;
		}

		if ($round->round_trip) {
			$clashes = PlayOffRoundClash::where('round_id', '=', $round->id)->get();
			foreach ($clashes as $clash) {
				$second_clash = new PlayOffRoundClash;
				$second_clash->round_id = $round->id;
				$second_clash->order = $clash->order;
				$second_clash->local_id = $clash->visitor_id;
				$second_clash->visitor_id = $clash->local_id;
				$second_clash->return_match = 1;
				$second_clash->save();
				$part++;
			}
		}

		return back()->with('success', 'Emparejamientos generados correctamente');
	}

	public function assing_local_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$round_id = $clash->round->id;

        $round_participants = PlayOffRoundParticipant::select('*')
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

		return back()->with('success', 'Participante local asignado al emparejamiento correctamente');
	}

	public function assing_visitor_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$round_id = $clash->round->id;

        $round_participants = PlayOffRoundParticipant::select('*')
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

		return back()->with('success', 'Participante visitante asignado al emparejamiento correctamente');
	}

	public function liberate_local_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$clash->local_id = NULL;
		$clash->save();

		return back()->with('success', 'Participante local liberado correctamente');
	}

	public function liberate_visitor_participant_in_clash($clash_id)
	{
		$clash = PlayOffRoundClash::find($clash_id);
		$clash->visitor_id = NULL;
		$clash->save();

		return back()->with('success', 'Participante visitante liberado correctamente');
	}

    protected function generate_clashes($round_id)
    {
    	$round = PlayOffRound::findOrFail($round_id);
		foreach ($round->clashes as $clash) {
			$clash->delete();
		}

		// for ($i=0; $i < ($round_participants->count() / 2); $i++) {
		// 	$clash = new PlayOffRoundClash;
		// 	$clash->round_id = $round->id;
		// 	$clash->order = $i + 1;
		// 	$clash->local_id = null;
		// 	$clash->visitor_id = null;
		// 	$clash->save();
		// }

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
		}

		if ($round->round_trip) {
			$clashes = PlayOffRoundClash::where('round_id', '=', $round->id)->get();
			foreach ($clashes as $clash) {
				$second_clash = new PlayOffRoundClash;
				$second_clash->round_id = $round->id;
				$second_clash->order = $clash->order;
				$second_clash->local_id = $clash->visitor_id;
				$second_clash->visitor_id = $clash->local_id;
				$second_clash->return_match = 1;
				$second_clash->save();
				$part++;
			}
		}

		return back()->with('success', 'Emparejamientos sorteados correctamente');
    }
}
