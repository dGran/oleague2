<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\TeamCategory;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class TeamController extends Controller
{
    public function index()
    {
    	$filterName = request()->filterName;
    	$filterCategory = request()->filterCategory;
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

        $teams = Team::teamCategoryId($filterCategory)->name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
        $categories = TeamCategory::orderBy('name', 'asc')->get();
    	return view('admin.teams.index', compact('teams', 'categories', 'filterName', 'filterCategory', 'order', 'pagination'));
    }

    public function add()
    {
    	$categories = TeamCategory::orderBy('name', 'asc')->get();
    	return view('admin.teams.add', compact('categories'));
    }

    public function save()
    {
        $data = request()->validate([
            'name' => 'required|unique:teams,name',
            'team_category_id' => 'required',
            'logo' => [
                'image',
                'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
            ],
        ],
        [
            'name.required' => 'El nombre del equipo es obligatorio',
            'name.unique' => 'El nombre del equipo ya existe',
            'team_category_id.required' => 'La categoría de equipo es obligatoria',
            'logo.dimensions' => 'Las dimensiones de la imagen no son válidas'
        ]);

        $data['slug'] = str_slug(request()->name);

        if (request()->hasFile('logo')) {
            $image = request()->file('logo');
            $name = request()->team_category_id . '_' . date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/teams');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $data['logo'] = 'img/teams/' . $name;
        } else {
            $data['logo'] = null;
        }

        $team = Team::create($data);

        if ($team->save()) {
            event(new TableWasSaved($team, $team->name));
            if (request()->no_close) {
                return back()->with('success', 'Nuevo equipo registrado correctamente');
            }
            return redirect()->route('admin.teams')->with('success', 'Nuevo equipo registrado correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $team = Team::find($id);
        if ($team) {
            $categories = TeamCategory::orderBy('name', 'asc')->get();
            return view('admin.teams.edit', compact('team', 'categories'));
        } else {
            return back()->with('warning', 'Acción cancelada. El equipo que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $team = Team::find($id);

        if ($team) {
            $data = request()->validate([
                'name' => 'required|unique:teams,name,' .$team->id,
                'team_category_id' => 'required',
                'logo' => [
                    'image',
                    'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
                ],
            ],
            [
                'name.required' => 'El nombre del equipo es obligatorio',
                'name.unique' => 'El nombre del equipo ya existe',
                'team_category_id.required' => 'La categoría de equipo es obligatoria',
                'logo.dimensions' => 'Las dimensiones de la imagen no son válidas'
            ]);

            $data['slug'] = str_slug(request()->name);

            if (request()->hasFile('logo')) {
                $image = request()->file('logo');
                $name = request()->team_category_id . '_' . date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/img/teams');
                $imagePath = $destinationPath. "/".  $name;
                if (\File::exists(public_path($team->logo))) {
                   \File::delete(public_path($team->logo));
                }
                $image->move($destinationPath, $name);
                $data['logo'] = 'img/teams/' . $name;
            } else {
                if (!request()->old_logo) {
                    if ($team->logo) {
                        if (\File::exists(public_path($team->logo))) {
                           \File::delete(public_path($team->logo));
                        }
                        $data['logo'] = '';
                    }
                }
            }

            $team->fill($data);
            if ($team->isDirty()) {
                $team->update($data);

                if ($team->update()) {
                    event(new TableWasUpdated($team, $team->name));
                    return redirect()->route('admin.teams')->with('success', 'Cambios guardados en equipo "' . $team->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.teams')->with('info', 'No se han detectado cambios en el equipo "' . $team->name . '".');

        } else {
            return redirect()->route('admin.teams')->with('warning', 'Acción cancelada. El equipo que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $team = Team::find($id);

        if ($team) {
            $message = 'Se ha eliminado el equipo "' . $team->name . '" correctamente.';

            if ($team->isLocalLogo()) {
                if (\File::exists(public_path($team->logo))) {
                    \File::delete(public_path($team->logo));
                }
            }
            event(new TableWasDeleted($team, $team->name));
            $team->delete();

            return redirect()->route('admin.teams')->with('success', $message);
        } else {
            $message = 'Acción cancelada. El equipo que querías eliminar ya no existe. Se ha actualizado la lista';

            return back()->with('warning', $message);
        }
    }

    public function destroyMany($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $team = Team::find($ids[$i]);
            if ($team) {
                $counter = $counter +1;
                if ($team->isLocalLogo()) {
                    if (\File::exists(public_path($team->logo))) {
                        \File::delete(public_path($team->logo));
                    }
                }
                event(new TableWasDeleted($team, $team->name));
                $team->delete();
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.teams')->with('success', 'Se han eliminado los equipos seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Los equipos que querías eliminar ya no existen.');
        }
    }

    public function view($id) {
        $team = Team::find($id);
        if ($team) {
            return view('admin.teams.index.view', compact('team'))->render();
        } else {
            return view('admin.teams.index.view-empty')->render();
        }
    }

    public function duplicate($id)
    {
        $team = Team::find($id);

    	if ($team) {
	    	$newTeam = $team->replicate();
	    	$newTeam->name .= " (copia)";
            $newTeam->slug = str_slug($newTeam->name);

            if ($newTeam->logo) {
                if ($newTeam->isLocalLogo()) {
                    $extension = strstr($newTeam->logo, '.');
                    $logo = 'img/teams/' . $newTeam->team_category_id . '_' . date('mdYHis') . uniqid() . $extension;
                    $sourceFilePath = public_path() . '/' . $newTeam->logo;
                    $destinationPath = public_path() .'/' . $logo;
                    if (\File::exists($sourceFilePath)) {
                        \File::copy($sourceFilePath,$destinationPath);
                    }

                    $newTeam->logo = $logo;
                }
            }

	    	$newTeam->save();

            if ($newTeam->save()) {
                event(new TableWasSaved($newTeam, $newTeam->name));
            }

	    	return redirect()->route('admin.teams')->with('success', 'Se ha duplicado el equipo "' . $newTeam->name . '" correctamente.');
	    } else {
	    	return back()->with('warning', 'Acción cancelada. El equipo que querías duplicar ya no existe. Se ha actualizado la lista.');
	    }
    }

    public function duplicateMany($ids)
    {
    	$ids=explode(",",$ids);
    	$counter = 0;
    	for ($i=0; $i < count($ids); $i++)
    	{
	    	$original = Team::find($ids[$i]);
	    	if ($original) {
	    		$counter = $counter +1;
		    	$team = $original->replicate();
		    	$team->name .= " (copia)";
                $team->slug = str_slug($team->name);

                if ($team->logo) {
                    if ($team->isLocalLogo()) {
                        $extension = strstr($team->logo, '.');
                        $logo = 'img/teams/' . $team->team_category_id . '_' . date('mdYHis') . uniqid() . $extension;
                        $sourceFilePath = public_path() . '/' . $team->logo;
                        $destinationPath = public_path() .'/' . $logo;
                        if (\File::exists($sourceFilePath)) {
                            \File::copy($sourceFilePath,$destinationPath);
                        }

                        $team->logo = $logo;
                    }
                }

		    	$team->save();

                if ($team->save()) {
                    event(new TableWasSaved($team, $team->name));
                }
		    }
    	}
    	if ($counter > 0) {
    		return redirect()->route('admin.teams')->with('success', 'Se han duplicado los equipos seleccionados correctamente.');
    	} else {
    		return back()->with('warning', 'Acción cancelada. Los equipos que querías duplicar ya no existen. Se ha actualizado la lista.');
    	}
    }

    public function exportFile($filename, $type, $filterName, $filterCategory, $order, $ids = null)
    {
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        if ($filterName == "null") { $filterName =""; }
        if ($filterCategory == "null") { $filterCategory =""; }

        if ($ids) {
            $ids = explode(",",$ids);
            $teams = Team::whereIn('id', $ids)
                ->teamCategoryId($filterCategory)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $teams = Team::teamCategoryId($filterCategory)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'equipos_export' . time();
        }
        return \Excel::create($filename, function($excel) use ($teams) {
            $excel->sheet('equipos', function($sheet) use ($teams)
            {
                $sheet->fromArray($teams);
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
                        $team = new Team;
                        $team->team_category_id = $value->team_category_id;
                        $team->name = $value->name;
                        $team->logo = $value->logo;
                        $team->slug = str_slug($value->name);

                        if ($team) {
                            $team->save();
                            if ($team->save()) {
                                event(new TableWasImported($team, $team->name));
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
