<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SeasonParticipant;
use App\SeasonCompetitionPhaseGroup;
use App\SeasonCompetitionPhaseGroupParticipant;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;


class SeasonCompetitionPhaseGroupParticipantController extends Controller
{
    public function index($competition_slug, $phase_slug, $group_slug)
    {

    	// estoy adaptando el index de season_participants`
    	// $competition = SeasonCompetition::where('slug', '=', $competition_slug);
    	// if ($competition->season->participant_has_team) {

    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $participants = SeasonCompetitionPhaseGroupParticipant::where('group_id', '=', $group->id)->get();

        return view('admin.seasons_competitions_phases_groups_participants.index', compact('participants', 'group'));
    }

    public function add($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();

        $participants = SeasonParticipant::where('season_id', '=', $group->phase->competition->season_id)
        ->whereNotIn('id', function($query) use ($group) {
           $query->select('participant_id')->from('season_competitions_phases_groups_participants')->whereNotNull('participant_id')->where('group_id', '=', $group->id);
        })->get();


        // $participants = \DB::table("season_participants")->select('*')
        // ->whereNotIn('id', function($query) use ($group) {
        //    $query->select('participant_id')->from('season_competitions_phases_groups_participants')->whereNotNull('participant_id')->where('group_id', '=', $group->id);
        // })->get();

        return view('admin.seasons_competitions_phases_groups_participants.add', compact('group', 'participants'));
    }

    public function save($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();

        $data = request()->all();
        $data['group_id'] = $group->id;
        $participant = SeasonCompetitionPhaseGroupParticipant::create($data);

        if ($participant->save()) {
            event(new TableWasSaved($participant, $participant->participant->name()));
            if (request()->no_close) {
                return back()->with('success', 'Nuevo participante registrado correctamente');
            }
            return redirect()->route('admin.season_competitions_phases_groups_participants', [$competition_slug, $phase_slug, $group_slug])->with('success', 'Nuevo participante registrado correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }
}