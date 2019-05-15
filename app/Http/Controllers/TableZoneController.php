<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TableZone;
use App\AdminFilter;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;


class TableZoneController extends Controller
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
                if ($admin->table_zone_page) {
                    $page = $admin->table_zone_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->table_zone_filterName) {
                    $filterName = $admin->table_zone_filterName;
                }
                if ($admin->table_zone_order) {
                    $order = $admin->table_zone_order;
                }
                if ($admin->table_zone_pagination) {
                    $pagination = $admin->table_zone_pagination;
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
        $adminFilter->table_zone_filterName = $filterName;
        $adminFilter->table_zone_order = $order;
        $adminFilter->table_zone_pagination = $pagination;
        $adminFilter->table_zone_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('table_zone_page')) {
            $page = 1;
            $adminFilter->table_zone_page = $page;
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


        $table_zones = TableZone::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        if ($table_zones->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $table_zones = TableZone::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->table_zone_page = $page;
            $adminFilter->save();
        }
        return view('admin.table_zones.index', compact('table_zones', 'filterName', 'order', 'pagination', 'page'));
    }

    public function add()
    {
    	return view('admin.table_zones.add');
    }

    public function save()
    {
        $data = request()->validate([
            'name' => 'required|unique:table_zones,name',
            'img' => [
                'image',
                'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
            ],
        ],
        [
            'name.required' => 'El nombre del marcado de zonas es obligatorio',
            'name.unique' => 'El nombre del marcado de zonas ya existe',
            'img.image' => 'El archivo debe contener una imagen',
            'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
        ]);

        $data['slug'] = str_slug(request()->name);

        if (request()->hasFile('img')) {
            $image = request()->file('img');
            $name = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/table_zones');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $data['img'] = 'img/table_zones/' . $name;
        } else {
            $data['img'] = null;
        }

        $table_zone = TableZone::create($data);

        if ($table_zone->save()) {
            event(new TableWasSaved($table_zone, $table_zone->name));
            if (request()->no_close) {
                return back()->with('success', 'Nuevo marcado de zonas registrado correctamente');
            }
            return redirect()->route('admin.table_zones')->with('success', 'Nuevo marcado de zonas registrado correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $table_zone = TableZone::find($id);
        if ($table_zone) {
            return view('admin.table_zones.edit', compact('table_zone'));
        } else {
            return back()->with('warning', 'Acción cancelada. El marcado de zonas que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $table_zone = TableZone::find($id);

        if ($table_zone) {

            $data = request()->validate([
                'name' => 'required|unique:table_zones,name,' .$table_zone->id,
                'img' => [
                    'image',
                    'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
                ],
            ],
            [
                'name.required' => 'El nombre del marcado de zonas es obligatorio',
                'name.unique' => 'El nombre del marcado de zonas ya existe',
                'img.image' => 'El archivo debe contener una imagen',
                'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
            ]);

            $data['slug'] = str_slug(request()->name);

            if (request()->hasFile('img')) {
                $image = request()->file('img');
                $name = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/img/table_zones');
                $imagePath = $destinationPath. "/".  $name;
                if (\File::exists(public_path($table_zone->img))) {
                   \File::delete(public_path($table_zone->img));
                }
                $image->move($destinationPath, $name);
                $data['img'] = 'img/table_zones/' . $name;
            } else {
                if (!request()->old_img) {
                    if ($table_zone->img) {
                        if (\File::exists(public_path($table_zone->img))) {
                           \File::delete(public_path($table_zone->img));
                        }
                        $data['img'] = '';
                    }
                }
            }

            $table_zone->fill($data);
            if ($table_zone->isDirty()) {
                $table_zone->update($data);

                if ($table_zone->update()) {
                    event(new TableWasUpdated($table_zone, $table_zone->name));
                    return redirect()->route('admin.table_zones')->with('success', 'Cambios guardados en marcado de zonas "' . $table_zone->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.table_zones')->with('info', 'No se han detectado cambios en el marcado de zonas "' . $table_zone->name . '".');

        } else {
            return redirect()->route('admin.table_zones')->with('warning', 'Acción cancelada. El marcado de zonas que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $table_zone = TableZone::find($id);

        if ($table_zone) {
            $message = 'Se ha eliminado el marcado de zonas "' . $table_zone->name . '" correctamente.';

            if ($table_zone->isLocalImg()) {
                if (\File::exists(public_path($table_zone->img))) {
                    \File::delete(public_path($table_zone->img));
                }
            }
            event(new TableWasDeleted($table_zone, $table_zone->name));
            $table_zone->delete();

            return redirect()->route('admin.table_zones')->with('success', $message);
        } else {
            $message = 'Acción cancelada. El marcado de zonas que querías eliminar ya no existe. Se ha actualizado la lista';

            return back()->with('warning', $message);
        }
    }

    public function destroyMany($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $table_zone = TableZone::find($ids[$i]);
            if ($table_zone) {
                $counter = $counter +1;
                if ($table_zone->isLocalImg()) {
                    if (\File::exists(public_path($table_zone->img))) {
                        \File::delete(public_path($table_zone->img));
                    }
                }
                event(new TableWasDeleted($table_zone, $table_zone->name));
                $table_zone->delete();
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.table_zones')->with('success', 'Se han eliminado los marcado de zonas seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Los marcado de zonas que querías eliminar ya no existen.');
        }
    }

    public function duplicate($id)
    {
        $table_zone = TableZone::find($id);

    	if ($table_zone) {
	    	$newTableZone = $table_zone->replicate();
	    	$newTableZone->name .= " (copia)";
            $newTableZone->slug = str_slug($newTableZone->name);

            if ($newTableZone->img) {
                if ($newTableZone->isLocalImg()) {
                    $extension = strstr($newTableZone->img, '.');
                    $img = 'img/table_zones/' . date('mdYHis') . uniqid() . $extension;
                    $sourceFilePath = public_path() . '/' . $newTableZone->img;
                    $destinationPath = public_path() .'/' . $img;
                    if (\File::exists($sourceFilePath)) {
                        \File::copy($sourceFilePath,$destinationPath);
                    }

                    $newTableZone->img = $img;
                }
            }

	    	$newTableZone->save();

            if ($newTableZone->save()) {
                event(new TableWasSaved($newTableZone, $newTableZone->name));
            }

	    	return redirect()->route('admin.table_zones')->with('success', 'Se ha duplicado el marcado de zonas"' . $newTableZone->name . '" correctamente.');
	    } else {
	    	return back()->with('warning', 'Acción cancelada. El marcado de zonas que querías duplicar ya no existe. Se ha actualizado la lista.');
	    }
    }

    public function duplicateMany($ids)
    {
    	$ids=explode(",",$ids);
    	$counter = 0;
    	for ($i=0; $i < count($ids); $i++)
    	{
	    	$original = TableZone::find($ids[$i]);
	    	if ($original) {
	    		$counter = $counter +1;
		    	$table_zone = $original->replicate();
		    	$table_zone->name .= " (copia)";
                $table_zone->slug = str_slug($table_zone->name);

                if ($table_zone->img) {
                    if ($table_zone->isLocalimg()) {
                        $extension = strstr($table_zone->img, '.');
                        $img = 'img/table_zones/' . date('mdYHis') . uniqid() . $extension;
                        $sourceFilePath = public_path() . '/' . $table_zone->img;
                        $destinationPath = public_path() .'/' . $img;
                        if (\File::exists($sourceFilePath)) {
                            \File::copy($sourceFilePath,$destinationPath);
                        }

                        $table_zone->img = $img;
                    }
                }

		    	$table_zone->save();

                if ($table_zone->save()) {
                    event(new TableWasSaved($table_zone, $table_zone->name));
                }
		    }
    	}
    	if ($counter > 0) {
    		return redirect()->route('admin.table_zones')->with('success', 'Se han duplicado los marcado de zonas seleccionados correctamente.');
    	} else {
    		return back()->with('warning', 'Acción cancelada. Los marcado de zonas que querías duplicar ya no existen. Se ha actualizado la lista.');
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
            $table_zones = TableZone::whereIn('id', $ids)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $table_zones = TableZone::name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if ($filename == null) {
            $filename = 'marcado_de_zonas_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($table_zones) {
            $excel->sheet('marcado_de_zonas', function($sheet) use ($table_zones)
            {
                $sheet->fromArray($table_zones);
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
                        $table_zone = new TableZone;
                        $table_zone->name = $value->name;
                        $table_zone->img = $value->img;
                        $table_zone->slug = str_slug($value->name);

                        if ($table_zone) {
                            $table_zone->save();
                            if ($table_zone->save()) {
                                event(new TableWasImported($table_zone, $table_zone->name));
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