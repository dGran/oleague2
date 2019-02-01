<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonController extends Controller
{
    public function index()
    {
        $filterName = request()->filterName;
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

        $seasons = Season::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
        return view('admin.seasons.index', compact('seasons', 'filterName', 'order', 'pagination'));
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

        $data['slug'] = str_slug(request()->name);

        $season = Season::create($data);

        if ($season->save()) {
            event(new TableWasSaved($season, $season->name));
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

            $data['slug'] = str_slug(request()->name);

            $season->fill($data);
            if ($season->isDirty()) {
                $season->update($data);

                if ($season->update()) {
                    event(new TableWasUpdated($season, $season->name));
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
