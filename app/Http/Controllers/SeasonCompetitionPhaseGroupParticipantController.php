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

    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $participants = SeasonCompetitionPhaseGroupParticipant::where('group_id', '=', $group->id)->get();

        return view('admin.seasons_competitions_phases_groups_participants.index', compact('participants', 'group'));
    }

    public function add($competition_slug, $phase_slug, $group_slug)
    {
    	$group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $phase_groups = SeasonCompetitionPhaseGroup::where('phase_id', '=', $group->phase_id)->get();
        $participants = SeasonParticipant::where('season_id', '=', $group->phase->competition->season_id);
        foreach ($phase_groups as $phase_group) {
            $participants = $participants->whereNotIn('id', function($query) use ($phase_group) {
                $query->select('participant_id')->from('season_competitions_phases_groups_participants')->whereNotNull('participant_id')->where('group_id', '=', $phase_group->id);
            });
        }
        $participants = $participants->get();

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

    public function destroy($competition_slug, $phase_slug, $group_slug, $id)
    {
        $participant = SeasonCompetitionPhaseGroupParticipant::find($id);

        if ($participant) {
            if ($participant->participant) {
                $name = $participant->participant->name();
            } else {
                $name = "Participante #" . $participant->id . " - inexistente";
            }
            $message = 'Se ha eliminado el participante "' . $name . '" del grupo correctamente.';
            event(new TableWasDeleted($participant, $name));
            $participant->delete();

            return redirect()->route('admin.season_competitions_phases_groups_participants', [$competition_slug, $phase_slug, $group_slug])->with('success', $message);
        } else {
            $message = 'Acción cancelada. El participante que querías eliminar ya no existe. Se ha actualizado la lista';
            return back()->with('warning', $message);
        }
    }

    public function destroyMany($competition_slug, $phase_slug, $group_slug, $ids)
    {
        $ids=explode(",",$ids);
        $counter_deleted = 0;
        // $counter_no_allow = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $participant = SeasonCompetitionPhaseGroupParticipant::find($ids[$i]);
            if ($participant) {
                if ($participant->participant) {
                    $name = $participant->participant->name();
                } else {
                    $name = "Participante #" . $participant->id . " - inexistente";
                }
                // if (!$participant->hasTeams()) {
                    $counter_deleted = $counter_deleted +1;
                    event(new TableWasDeleted($participant, $name));
                    $participant->delete();
                // } else {
                    // $counter_no_allow = $counter_no_allow +1;
                // }
            }
        }
        if ($counter_deleted > 0) {
            // if ($counter_no_allow > 0) {
                // return redirect()->route('admin.teams_categories')->with('success', 'Se han eliminado las categorías seleccionadas correctamente excepto las que tienen equipos asociados.');
            // } else {
                return redirect()->route('admin.season_competitions_phases_groups_participants', [$competition_slug, $phase_slug, $group_slug])->with('success', 'Se han eliminado los participantes seleccionados del grupo correctamente.');
            // }
        } else {
            // if ($counter_no_allow > 0) {
                // return back()->with('warning', 'Acción cancelada. No es posible eliminar las categorías seleccionadas ya que tienen equipos asociados.');
            // } else {
                return back()->with('warning', 'Acción cancelada. Los participantes que querías eliminar ya no existen.');
            // }
        }
    }

    public function raffle($competition_slug, $phase_slug, $group_slug)
    {
        $group = SeasonCompetitionPhaseGroup::where('slug', '=', $group_slug)->firstOrFail();
        $free = $group->num_participants - $group->participants->count();
        if ($free > 0) {
            $phase_groups = SeasonCompetitionPhaseGroup::where('phase_id', '=', $group->phase_id)->get();
            for ($i=0; $i < $free; $i++) {

                $participants = SeasonParticipant::where('season_id', '=', $group->phase->competition->season_id);
                foreach ($phase_groups as $phase_group) {
                    $participants = $participants->whereNotIn('id', function($query) use ($phase_group) {
                        $query->select('participant_id')->from('season_competitions_phases_groups_participants')->whereNotNull('participant_id')->where('group_id', '=', $phase_group->id);
                    });
                }
                $participants = $participants->get();

                $free_participants = [];
                foreach ($participants as $participant) {
                    array_push($free_participants, $participant->id);
                }

                $result = array_rand ($free_participants, 1);
                $group_participant = SeasonCompetitionPhaseGroupParticipant::create([
                    'group_id' => $group->id,
                    'participant_id' => $free_participants[$result]
                ]);
                // dd($group_participant->id);
                event(new TableWasSaved($group_participant, $group_participant->participant->name()));
            }

            return redirect()->route('admin.season_competitions_phases_groups_participants', [$competition_slug, $phase_slug, $group_slug])->with('success', 'Se ha completado el grupo mediante sorteo de participantes correctamente.');

        } else {
            return back()->with('warning', 'Acción cancelada. El grupo ya está completo.');
        }
    }

    public function exportFile($competition_slug, $phase_slug, $group_slug, $filename, $type, $ids = null)
    {
        $group = SeasonCompetitionPhaseGroup::where('slug','=', $group_slug)->firstOrFail();
        if ($ids) {
            $ids = explode(",",$ids);
            $participants = SeasonCompetitionPhaseGroupParticipant::whereIn('id', $ids)
                ->where('group_id', '=', $group->id)
                ->orderBy('id', 'asc')
                ->get()->toArray();
        } else {
            $participants = SeasonCompetitionPhaseGroupParticipant::where('group_id', '=', $group->id)
                ->orderBy('id', 'asc')
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'season_competitions_phases_groups_participants_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($participants, $group) {
            $excel->sheet($group->name . ' - Participantes', function($sheet) use ($participants)
            {
                $sheet->fromArray($participants);
            });
        })->download($type);
    }

    public function importFile($competition_slug, $phase_slug, $group_slug, Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = \Excel::load($path)->get();

            $group = SeasonCompetitionPhaseGroup::where('slug','=', $group_slug)->firstOrFail();
            $new_regs = $data->count();
            $current_participants = $group->participants->count();
            if ($current_participants + $new_regs > $group->num_participants) {
                return back()->with('error', 'No se pueden importar los datos ya que superaría el máximo de participantes del grupo.');
            } else {
                if ($data->count()) {
                    foreach ($data as $key => $value) {
                        try {
                            $participant = new SeasonCompetitionPhaseGroupParticipant;
                            $participant->group_id = $value->group_id;
                            $participant->participant_id = $value->participant_id;

                            if ($participant) {
                                $participant->save();
                                if ($participant->save()) {
                                    if ($participant->participant) {
                                        $name = $participant->participant->name();
                                    } else {
                                        $name = "Participante #" . $participant->id . " - inexistente";
                                    }
                                    event(new TableWasImported($participant, $name));
                                }
                            }
                        }
                        catch (\Exception $e) {
                            return back()->with('error', 'Fallo al importar los datos, el archivo es inválido o no tiene el formato necesario.');
                        }
                    }
                    return back()->with('success', 'Datos importados correctamente.');
                } else {
                    return back()->with('error', 'Fallo al importar los datos, el archivo no contiene datos.');
                }
            }
        }
        return back()->with('error', 'No has cargado ningún archivo.');
    }

}