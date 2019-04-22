<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SeasonCompetitionPhase;
use App\SeasonCompetitionPhaseGroup;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonCompetitionPhaseGroupController extends Controller
{
    public function index($competition_slug, $phase_slug)
    {
        $phase = SeasonCompetitionPhase::where('slug','=', $phase_slug)->firstOrFail();
        $groups = SeasonCompetitionPhaseGroup::where('phase_id', '=', $phase->id)->orderBy('order', 'asc')->get();

        return view('admin.seasons_competitions_phases.index', compact('phases', 'competition'));
    }

    public function add($competition_slug, $phase_slug)
    {
        $competition = SeasonCompetition::where('slug','=', $slug)->firstOrFail();
        $max_participants = $this->calculateMaxParticipants($competition->id);
        return view('admin.seasons_competitions_phases.add', compact('competition', 'max_participants'));
    }

    public function save($competition_slug, $phase_slug)
    {
        $data = request()->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre de la fase es obligatorio',
        ]);

        $competition = SeasonCompetition::where('slug','=', $slug)->firstOrFail();

        $data = request()->all();
        $data['competition_id'] = $competition->id;
        $data['order'] = $this->calculateOrder($competition->id);
        $data['active'] = 0;
        $data['slug'] = str_slug(request()->name);

        $phase = SeasonCompetitionPhase::create($data);

        if ($phase->save()) {
            event(new TableWasSaved($phase, $phase->name));
            if (request()->no_close) {
                return back()->with('success', 'Nueva fase registrada correctamente en ' . $competition->name);
            }
            return redirect()->route('admin.season_competitions_phases', $slug)->with('success', 'Nueva fase registrada correctamente en ' . $competition->name);
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($competition_slug, $phase_slug, $id)
    {
        $phase = SeasonCompetitionPhase::find($id);
        $competition = SeasonCompetition::where('slug','=', $slug)->firstOrFail();
        $max_participants = $this->calculateMaxParticipants($competition->id);

        if ($phase) {
            return view('admin.seasons_competitions_phases.edit', compact('phase', 'competition', 'max_participants'));
        } else {
            return back()->with('warning', 'Acción cancelada. La fase que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($competition_slug, $phase_slug, $id)
    {
    	$competition = SeasonCompetition::where('slug','=', $slug)->firstOrFail();
        $phase = SeasonCompetitionPhase::find($id);

        if ($phase) {
            $data = request()->validate([
                'name' => 'required',
            ],
            [
                'name.required' => 'El nombre de la fase es obligatorio',
            ]);

            $data = request()->all();
            $data['order'] = $this->calculateOrder($competition->id);
            $data['slug'] = str_slug(request()->name);

            $phase->fill($data);
            if ($phase->isDirty()) {
                $phase->update($data);

                if ($phase->update()) {
                    event(new TableWasUpdated($phase, $phase->name));
                    return redirect()->route('admin.season_competitions_phases', $competition->slug)->with('success', 'Cambios guardados en la fase "' . $phase->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }
            return redirect()->route('admin.season_competitions_phases', $competition->slug)->with('info', 'No se han detectado cambios en la fase "' . $phase->name . '".');

        } else {
            return redirect()->route('admin.season_competitions_phases', $competition->slug)->with('warning', 'Acción cancelada. La fase que estabas editando ya no existe. Se ha actualizado la lista');
        }
    }

    public function destroy($competition_slug, $phase_slug, $id)
    {
        $phase = SeasonCompetitionPhase::find($id);

        if ($phase) {
            $message = 'Se ha eliminado la fase "' . $phase->name . '" correctamente.';
            event(new TableWasDeleted($phase, $phase->name));
            $phase->delete();

            return redirect()->route('admin.season_competitions_phases', $slug)->with('success', $message);
        } else {
            $message = 'Acción cancelada. La fase que querías eliminar ya no existe. Se ha actualizado la lista';
            return back()->with('warning', $message);
        }
    }

    public function destroyMany($competition_slug, $phase_slug, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $phase = SeasonCompetitionPhase::find($ids[$i]);
            if ($phase) {
                $counter = $counter +1;
                event(new TableWasDeleted($phase, $phase->name));
                $phase->delete();
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.season_competitions_phases', $slug)->with('success', 'Se han eliminado las fases seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Las fases que querías eliminar ya no existen.');
        }
    }

    public function exportFile($competition_slug, $phase_slug, $filename, $type, $ids = null)
    {
    	$competition = SeasonCompetition::where('slug','=', $slug)->firstOrFail();
        if ($ids) {
            $ids = explode(",",$ids);
            $phases = SeasonCompetitionPhase::whereIn('id', $ids)
                ->where('competition_id', '=', $competition->id)
                ->orderBy('order', 'asc')
                ->get()->toArray();
        } else {
            $phases = SeasonCompetitionPhase::where('competition_id', '=', $competition->id)
                ->orderBy('order', 'asc')
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'season_competitions_phases_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($phases) {
            $excel->sheet('season_competitions_phases', function($sheet) use ($phases)
            {
                $sheet->fromArray($phases);
            });
        })->download($type);
    }

    public function importFile($competition_slug, $phase_slug, Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = \Excel::load($path)->get();

            if ($data->count()) {
                foreach ($data as $key => $value) {
                    try {
                        $phase = new SeasonCompetitionPhase;
                        $phase->competition_id = $value->competition_id;
                        $phase->name = $value->name;
                        $phase->mode = $value->mode;
                        $phase->num_participants = $value->num_participants;
                        $phase->order = $value->order;
                        $phase->active = is_null($value->active) ? 0 : $value->active;
                        $phase->slug = str_slug($value->name);

                        if ($phase) {
                            $phase->save();
                            if ($phase->save()) {
                                event(new TableWasImported($phase, $phase->name));
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
        return back()->with('error', 'No has cargado ningún archivo.');
    }

    /*
     * HELPERS FUNCTIONS
     *
     */

    protected function calculateMaxParticipants($phase_id) {

    }
}
