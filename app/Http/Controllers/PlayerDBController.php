<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerDB;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class PlayerDBController extends Controller
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

        $databases = PlayerDB::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
    	return view('admin.players_dbs.index', compact('databases', 'filterName', 'order', 'pagination'));
    }

    public function add()
    {
    	return view('admin.players_dbs.add');
    }

    public function save()
    {
        $data = request()->validate([
            'name' => 'required|unique:team_categories,name',
        ],
        [
            'name.required' => 'El nombre de la categoría es obligatorio',
            'name.unique' => 'El nombre de la categoría ya existe',
        ]);

        $data['slug'] = str_slug(request()->name);

        $database = PlayerDB::create($data);

        if ($database->save()) {
            event(new TableWasSaved($database, $database->name));
            if (request()->no_close) {
                return back()->with('success', 'Nueva database registrada correctamente');
            }
            return redirect()->route('admin.players_dbs')->with('success', 'Nueva database registrada correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $database = PlayerDB::find($id);
        if ($database) {
            return view('admin.players_dbs.edit', compact('database'));
        } else {
            return back()->with('warning', 'Acción cancelada. La database que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $database = PlayerDB::find($id);

        if ($database) {
            $data = request()->validate([
                'name' => 'required|unique:players_dbs,name,' .$database->id,
            ],
            [
	            'name.required' => 'El nombre de la database es obligatorio',
	            'name.unique' => 'El nombre de la database ya existe',
            ]);

            $data['slug'] = str_slug(request()->name);

            $database->fill($data);
            if ($database->isDirty()) {
                $database->update($data);

                if ($database->update()) {
                    event(new TableWasUpdated($database, $database->name));
                    return redirect()->route('admin.players_dbs')->with('success', 'Cambios guardados en la database "' . $database->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.players_dbs')->with('info', 'No se han detectado cambios en la database "' . $database->name . '".');

        } else {
            return redirect()->route('admin.players_dbs')->with('warning', 'Acción cancelada. La database que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $database = PlayerDB::find($id);

        if ($database) {
            $message = 'Se ha eliminado la database "' . $database->name . '" correctamente.';

            event(new TableWasDeleted($database, $database->name));
            $database->delete();

            return redirect()->route('admin.players_dbs')->with('success', $message);
        } else {
            $message = 'Acción cancelada. La database que querías eliminar ya no existe. Se ha actualizado la lista';
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
            $database = PlayerDB::find($ids[$i]);
            if ($database) {
                if (!$database->hasPlayers()) {
                    $counter_deleted = $counter_deleted +1;
                    event(new TableWasDeleted($database, $database->name));
                    $database->delete();
                } else {
                    $counter_no_allow = $counter_no_allow +1;
                }
            }
        }
        if ($counter_deleted > 0) {
            if ($counter_no_allow > 0) {
                return redirect()->route('admin.players_dbs')->with('success', 'Se han eliminado las databases seleccionadas correctamente excepto las que tienen jugadores asociados.');
            } else {
                return redirect()->route('admin.players_dbs')->with('success', 'Se han eliminado las databases seleccionadas correctamente.');
            }
        } else {
            if ($counter_no_allow > 0) {
                return back()->with('warning', 'Acción cancelada. No es posible eliminar las databases seleccionadas ya que tienen jugadores asociados.');
            } else {
                return back()->with('warning', 'Acción cancelada. La databases que querías eliminar ya no existen.');
            }
        }
    }

    public function duplicate($id)
    {
        $database = PlayerDB::find($id);

    	if ($database) {
	    	$newDatabase = $database->replicate();
	    	$newDatabase->name .= " (copia)";
            $newDatabase->slug = str_slug($newDatabase->name);

	    	$newDatabase->save();

            if ($newDatabase->save()) {
                event(new TableWasSaved($newDatabase, $newDatabase->name));
            }

	    	return redirect()->route('admin.players_dbs')->with('success', 'Se ha duplicado la database "' . $newDatabase->name . '" correctamente.');
	    } else {
	    	return back()->with('warning', 'Acción cancelada. La database que querías duplicar ya no existe. Se ha actualizado la lista.');
	    }
    }

    public function duplicateMany($ids)
    {
    	$ids=explode(",",$ids);
    	$counter = 0;
    	for ($i=0; $i < count($ids); $i++)
    	{
	    	$original = PlayerDB::find($ids[$i]);
	    	if ($original) {
	    		$counter = $counter +1;
		    	$database = $original->replicate();
		    	$database->name .= " (copia)";
                $database->slug = str_slug($database->name);

		    	$database->save();

                if ($database->save()) {
                    event(new TableWasSaved($database, $database->name));
                }
		    }
    	}
    	if ($counter > 0) {
    		return redirect()->route('admin.players_dbs')->with('success', 'Se han duplicado las databases seleccionadas correctamente.');
    	} else {
    		return back()->with('warning', 'Acción cancelada. Las databases que querías duplicar ya no existen. Se ha actualizado la lista.');
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
            $databases = PlayerDB::whereIn('id', $ids)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $databases = PlayerDB::name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'players_databases_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($databases) {
            $excel->sheet('players_dbs', function($sheet) use ($databases)
            {
                $sheet->fromArray($databases);
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
                        $database = new PlayerDB;
                        $database->name = $value->name;
                        $database->slug = str_slug($value->name);

                        if ($database) {
                            $database->save();
                            if ($database->save()) {
                                event(new TableWasImported($database, $database->name));
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
