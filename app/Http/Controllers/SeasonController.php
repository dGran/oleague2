<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\SeasonParticipant;
use App\SeasonParticipantCashHistory;
use App\AdminFilter;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonController extends Controller
{
    public function index()
    {
        $admin = AdminFilter::where('user_id', '=', \Auth::user()->id)->first();
        if ($admin) {
            $filterName = request()->filterName;
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
            if (!$page) {
                if ($admin->season_page) {
                    $page = $admin->season_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->season_filterName) {
                    $filterName = $admin->season_filterName;
                }
                if ($admin->season_order) {
                    $order = $admin->season_order;
                }
                if ($admin->season_pagination) {
                    $pagination = $admin->season_pagination;
                }
            }
        } else {
            $admin = AdminFilter::create([
                'user_id' => \Auth::user()->id,
            ]);
            $filterName = request()->filterName;
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
        }

        $adminFilter = AdminFilter::find($admin->id);
        $adminFilter->season_filterName = $filterName;
        $adminFilter->season_order = $order;
        $adminFilter->season_pagination = $pagination;
        $adminFilter->season_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('season_page')) {
            $page = 1;
            $adminFilter->season_page = $page;
        }
        $adminFilter->save();

        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }

        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        $seasons = Season::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $seasons = Season::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->season_page = $page;
            $adminFilter->save();
        }
        return view('admin.seasons.index', compact('seasons', 'filterName', 'order', 'pagination', 'page'));
    }

    public function add()
    {
        return view('admin.seasons.add');
    }

    public function save()
    {
        $data = request()->validate([
            'name' => 'required|unique:seasons,name',
        ],
        [
            'name.required' => 'El nombre de la temporada es obligatorio',
            'name.unique' => 'El nombre de la temporada ya existe',
        ]);

        $data = request()->all();
        $data['slug'] = str_slug(request()->name);
        $data['num_participants'] = (is_null(request()->num_participants)) ? 0 : request()->num_participants;
        $data['participant_has_team'] = (is_null(request()->participant_has_team)) ? 0 : 1;
        $data['use_economy'] = (is_null(request()->use_economy)) ? 0 : 1;
        if (request()->use_economy) {
            $data['initial_budget'] = (is_null(request()->initial_budget)) ? 0 : request()->initial_budget;
        } else {
            $data['initial_budget'] = 0;
        }
        $data['use_rosters'] = (is_null(request()->use_rosters)) ? 0 : 1;
        $season = Season::create($data);

        if ($season->save()) {
            event(new TableWasSaved($season, $season->name));

            for ($i=1; $i < $season->num_participants+1; $i++) {
                $participant = new SeasonParticipant;
                $participant->name = "Participante " . $i;
                $participant->season_id = $season->id;
                $participant->team_id = null;
                $participant->user_id = null;
                $participant->budget = $season->initial_budget;
                $participant->paid_clauses = 0;
                $participant->clauses_received = 0;
                $participant->slug = str_slug($participant->name);
                $participant->save();
                if ($participant->save()) {
                    event(new TableWasSaved($participant, $participant->name));
                }

                if (request()->use_economy) {
                    $cash_history = new SeasonParticipantCashHistory;
                    $cash_history->participant_id = $participant->id;
                    $cash_history->description = "Presupuesto inicial";
                    $cash_history->amount = $season->initial_budget;
                    $cash_history->movement = "E";
                    $cash_history->save();
                    if ($cash_history->save()) {
                        event(new TableWasSaved($cash_history, $cash_history->description));
                    }
                }
            }

            if (request()->no_close) {
                return back()->with('success', 'Nueva temporada registrada correctamente');
            }
            return redirect()->route('admin.seasons')->with('success', 'Nueva temporada registrada correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $season = Season::find($id);
        if ($season) {
            return view('admin.seasons.edit', compact('season'));
        } else {
            return back()->with('warning', 'Acción cancelada. La temporada que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $season = Season::find($id);

        if ($season) {
            $data = request()->validate([
                'name' => 'required|unique:seasons,name,' .$season->id,
            ],
            [
                'name.required' => 'El nombre de la temporada es obligatorio',
                'name.unique' => 'El nombre de la temporada ya existe',
            ]);

            $data = request()->all();
            $data['slug'] = str_slug(request()->name);
            $data['num_participants'] = (is_null(request()->num_participants)) ? 0 : request()->num_participants;
            $data['participant_has_team'] = (is_null(request()->participant_has_team)) ? 0 : 1;
            $data['use_economy'] = (is_null(request()->use_economy)) ? 0 : 1;
            $data['initial_budget'] = (is_null(request()->initial_budget)) ? 0 : request()->initial_budget;
            $data['use_rosters'] = (is_null(request()->use_rosters)) ? 0 : 1;
            $season->fill($data);
            if ($season->isDirty()) {
                $season->update($data);

                if ($season->update()) {
                    event(new TableWasUpdated($season, $season->name));

                    //detectar si se ha cambiado el numero de participantes

                    // si es mayor dar de alta los nuevos participantes
                    // si es menor eliminar los sobrantes

                    // luego trabajar con su historial de caja

                    //detectar si ha cambiado el presupuesto inicial

                    $participants = SeasonParticipant::where('season_id', '=', $season->id);
                    foreach ($participants as $participant) {
                        $participant->name = "Participante " . $i;
                        $participant->season_id = $season->id;
                        $participant->team_id = null;
                        $participant->user_id = null;
                        $participant->budget = $season->initial_budget;
                        $participant->paid_clauses = 0;
                        $participant->clauses_received = 0;
                        $participant->slug = str_slug($participant->name);
                        $participant->save();
                        if ($participant->save()) {
                            event(new TableWasSaved($participant, $participant->name));
                        }
                    }

                    return redirect()->route('admin.seasons')->with('success', 'Cambios guardados en la temporada "' . $season->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.seasons')->with('info', 'No se han detectado cambios en la temporada "' . $season->name . '".');

        } else {
            return redirect()->route('admin.seasons')->with('warning', 'Acción cancelada. La temporada que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $season = Season::find($id);

        if ($season) {
            $message = 'Se ha eliminado la temporada "' . $season->name . '" correctamente.';

            event(new TableWasDeleted($season, $season->name));
            $season->delete();

            return redirect()->route('admin.seasons')->with('success', $message);
        } else {
            $message = 'Acción cancelada. La temporada que querías eliminar ya no existe. Se ha actualizado la lista';
            return back()->with('warning', $message);
        }
    }

    public function destroyMany($ids)
    {
        $ids=explode(",",$ids);
        $counter_deleted = 0;
        $counter_no_allow = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $season = Season::find($ids[$i]);
            if ($season) {
                $counter_deleted = 1;
                event(new TableWasDeleted($season, $season->name));
                $season->delete();
                // if (!$season->hasTeams()) {
                //     $counter_deleted = $counter_deleted +1;
                //     event(new TableWasDeleted($season, $season->name));
                //     $season->delete();
                // } else {
                //     $counter_no_allow = $counter_no_allow +1;
                // }
            }
        }
        if ($counter_deleted > 0) {
            if ($counter_no_allow > 0) {
                return redirect()->route('admin.seasons')->with('success', 'Se han eliminado las temporadas seleccionadas correctamente excepto las que tienen xxxx asociados.');
            } else {
                return redirect()->route('admin.seasons')->with('success', 'Se han eliminado las temporadas seleccionadas correctamente.');
            }
        } else {
            if ($counter_no_allow > 0) {
                return back()->with('warning', 'Acción cancelada. No es posible eliminar las temporadas seleccionadas ya que tienen xxxxx asociados.');
            } else {
                return back()->with('warning', 'Acción cancelada. La temporadas que querías eliminar ya no existen.');
            }
        }
    }

    public function duplicate($id)
    {
        $season = Season::find($id);

        if ($season) {
            $newseason = $season->replicate();
            $newseason->name .= " (copia)";
            $newseason->slug = str_slug($newseason->name);

            $newseason->save();

            if ($newseason->save()) {
                event(new TableWasSaved($newseason, $newseason->name));
            }

            return redirect()->route('admin.seasons')->with('success', 'Se ha duplicado la temporada "' . $newseason->name . '" correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. La temporada que querías duplicar ya no existe. Se ha actualizado la lista.');
        }
    }

    public function duplicateMany($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Season::find($ids[$i]);
            if ($original) {
                $counter = $counter +1;
                $season = $original->replicate();
                $season->name .= " (copia)";
                $season->slug = str_slug($season->name);

                $season->save();

                if ($season->save()) {
                    event(new TableWasSaved($season, $season->name));
                }
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.seasons')->with('success', 'Se han duplicado las temporadas seleccionadas correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Las temporadas que querías duplicar ya no existen. Se ha actualizado la lista.');
        }
    }

    public function exportFile($filename, $type, $filterName, $order, $ids = null)
    {
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        if ($filterName == "null") { $filterName =""; }

        if ($ids) {
            $ids = explode(",",$ids);
            $seasons = Season::whereIn('id', $ids)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $seasons = Season::name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'temporadas_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($seasons) {
            $excel->sheet('temporadas', function($sheet) use ($seasons)
            {
                $sheet->fromArray($seasons);
            });
        })->download($type);
    }

    public function importFile(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = \Excel::load($path)->get();

            if ($data->count()) {
                foreach ($data as $key => $value) {
                    try {
                        $season = new Season;
                        $season->name = $value->name;
                        $season->slug = str_slug($value->name);

                        if ($season) {
                            $season->save();
                            if ($season->save()) {
                                event(new TableWasImported($season, $season->name));
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
    protected function getOrder($order) {
        $order_ext = [
            'default' => [
                'sortField'     => 'id',
                'sortDirection' => 'desc'
            ],
            'date' => [
                'sortField'     => 'id',
                'sortDirection' => 'asc'
            ],
            'date_desc' => [
                'sortField'     => 'id',
                'sortDirection' => 'desc'
            ],
            'name' => [
                'sortField'     => 'name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'name',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}
