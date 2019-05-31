<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PlayOff;
use App\PlayOffRound;
use App\PlayOffRoundClash;
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
        $playoff = $this->check_playoff($group);

        return view('admin.seasons_competitions_phases_groups_playoffs.index', compact('group', 'playoff'));
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
        	$this->generate_rounds($playoff);
        }

        return $playoff;
    }

    protected function generate_rounds($playoff)
    {
        $participants = $playoff->group->participants->count();
        $rounds = 1;
        while ($participants > 2) {
        	$rounds++;
        	$participants = intval($participants / 2);
        }
        $playoff->rounds = $rounds;
        $playoff->save();

		for ($i=1; $i < $rounds+1; $i++) {
			$round = new PlayOffRound;
			$round->playoff_id = $playoff->id;
			$round->name = "Ronda " . $i;
			$round->save();
		}
    }

    protected function generate_clashes($competition_slug, $phase_slug, $group_slug, $round_id)
    {
    	$round = PlayOffRound::findOrFail($round_id);
		foreach ($round->clashes as $clash) {
			$clash->delete();
		}

    	$group_participants = SeasonCompetitionPhaseGroupParticipant::where('group_id', '=', $round->playoff->group->id)->inRandomOrder()->get();
		$part = 0;
		for ($i=0; $i < ($group_participants->count() / 2); $i++) {
			$clash = new PlayOffRoundClash;
			$clash->round_id = $round->id;
			$clash->order = $i + 1;
			$clash->local_id = $group_participants[$part]->id;
			// $clash->local_id = $group_participants[$part]->user->id;
			$part++;
			$clash->visitor_id = $group_participants[$part]->id;
			// $clash->local_id = $group_participants[$part]->user->id;
			$clash->save();
			$part++;
		}

		if ($round->round_trip) {
			$clashes = PlayOffRoundClash::where('round_id', '=', $round->id)->get();
			$part = 0;
			foreach ($clashes as $clash) {
				$second_clash = new PlayOffRoundClash;
				$second_clash->round_id = $round->id;
				$second_clash->order = $clash->order;
				$second_clash->visitor_id = $group_participants[$part]->id;
				// $second_clash->local_id = $group_participants[$part]->user->id;
				$part++;
				$second_clash->local_id = $group_participants[$part]->id;
				// $second_clash->local_id = $group_participants[$part]->user->id;
				$second_clash->second_match = 1;
				$second_clash->save();
				$part++;
			}
		}

		return back()->with('success', 'Emparejamientos sorteados correctamente');
    }
}
