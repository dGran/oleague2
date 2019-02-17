<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\User;
use App\Team;
use App\Season;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonParticipantController extends Controller
{
    public function index()
    {
        $filterSeason = request()->filterSeason;
        $order = request()->order;
        $pagination = request()->pagination;

        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }

        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        $participants = SeasonParticipant::seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
        $seasons = Season::orderBy('name', 'asc')->get();

    	return view('admin.seasons_participants.index', compact('participants', 'seasons', 'filterSeason', 'order', 'pagination'));
    }

    // public function add()
    // {
    // 	return view('admin.teams_categories.add');
    // }

    // public function save()
    // {
    //     $data = request()->validate([
    //         'name' => 'required|unique:team_categories,name',
    //     ],
    //     [
    //         'name.required' => 'El nombre de la categoría es obligatorio',
    //         'name.unique' => 'El nombre de la categoría ya existe',
    //     ]);

    //     $data['slug'] = str_slug(request()->name);

    //     $category = TeamCategory::create($data);

    //     if ($category->save()) {
    //         event(new TableWasSaved($category, $category->name));
    //         if (request()->no_close) {
    //             return back()->with('success', 'Nueva categoría registrada correctamente');
    //         }
    //         return redirect()->route('admin.teams_categories')->with('success', 'Nueva categoría registrada correctamente');
    //     } else {
    //         return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
    //     }
    // }

    public function edit($id)
    {
        $participant = SeasonParticipant::find($id);
        $teams = Team::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        if ($participant) {
            return view('admin.seasons_participants.edit', compact('participant', 'teams', 'users'));
        } else {
            return back()->with('warning', 'Acción cancelada. El participante que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $participant = SeasonParticipant::find($id);

        if ($participant) {
            $data = request()->validate([
                'name' => 'required',
            ],
            [
	            'name.required' => 'El nombre del participante es obligatorio',
            ]);

            $data = request()->all();
            $data['slug'] = str_slug(request()->name);

            $participant->fill($data);
            if ($participant->isDirty()) {
                $participant->update($data);

                if ($participant->update()) {
                    event(new TableWasUpdated($participant, $participant->name));
                    return redirect()->route('admin.season_participants')->with('success', 'Cambios guardados en el participante "' . $participant->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.season_participants')->with('info', 'No se han detectado cambios en el participante "' . $participant->name . '".');

        } else {
            return redirect()->route('admin.season_participants')->with('warning', 'Acción cancelada. El participante que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $participant = SeasonParticipant::find($id);

        if ($participant) {
            $message = 'Se ha eliminado el participante "' . $participant->name . '" correctamente.';

            event(new TableWasDeleted($participant, $participant->name));
            $participant->delete();

            return redirect()->route('admin.season_participants')->with('success', $message);
        } else {
            $message = 'Acción cancelada. El participante que querías eliminar ya no existe. Se ha actualizado la lista';
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
            $participant = SeasonParticipant::find($ids[$i]);
            if ($participant) {
                // if (!$participant->hasTeams()) {
                    $counter_deleted = $counter_deleted +1;
                    event(new TableWasDeleted($participant, $participant->name));
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
                return redirect()->route('admin.season_participants')->with('success', 'Se han eliminado los participantes seleccionados correctamente.');
            // }
        } else {
            // if ($counter_no_allow > 0) {
                // return back()->with('warning', 'Acción cancelada. No es posible eliminar las categorías seleccionadas ya que tienen equipos asociados.');
            // } else {
                return back()->with('warning', 'Acción cancelada. Los participantes que querías eliminar ya no existen.');
            // }
        }
    }

    public function exportFile($filename, $type, $filterSeason, $order, $ids = null)
    {
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        if ($filterSeason == "null") { $filterSeason =""; }

        if ($ids) {
            $ids = explode(",",$ids);
            $participants = SeasonParticipant::whereIn('id', $ids)
                ->seasonId($filterSeason)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $participants = SeasonParticipant::seasonId($filterSeason)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'participantes_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($participants) {
            $excel->sheet('participantes', function($sheet) use ($participants)
            {
                $sheet->fromArray($participants);
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
                        $participant = new SeasonParticipant;
                        $participant->name = $value->name;
                        $participant->season_id = $value->season_id;
                        $participant->team_id = $value->team_id;
                        $participant->user_id = $value->user_id;
                        $participant->budget = $value->budget;
                        $participant->paid_clauses = $value->paid_clauses;
                        $participant->clauses_received = $value->clauses_received;
                        $participant->slug = str_slug($value->name);

                        if ($participant) {
                            $participant->save();
                            if ($participant->save()) {
                                event(new TableWasImported($participant, $participant->name));
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
