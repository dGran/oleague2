<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\TeamCategory;

use App\Events\TeamWasSaved;

class TeamController extends Controller
{
    public function index(Request $request)
    {
    	$filterName = $request->filterName;
    	$filterCategory = $request->filterCategory;
        $order = $request->order;
        $pagination = $request->pagination;

        if (!$pagination == null) {
            if ($pagination == 'all') {
                $perPage = Team::count();

            } else {
                $perPage = $pagination;
            }
        } else {
            $perPage = 15;
        }

        switch ($order) {
            case "default": //default
                $sortField = "id";
                $sortDirection = "desc";
                break;
            case "date":
                $sortField = "id";
                $sortDirection = "asc";
                break;
            case "date_desc":
                $sortField = "id";
                $sortDirection = "desc";
                break;
            case "name":
                $sortField = "name";
                $sortDirection = "asc";
                break;
            case "name_desc":
                $sortField = "name";
                $sortDirection = "desc";
                break;
            default :
                $sortField = "id";
                $sortDirection = "desc";
                break;
        }

        $teams = Team::teamCategoryId($filterCategory)->name($filterName)->orderBy($sortField, $sortDirection)->paginate($perPage);
        $categories = TeamCategory::orderBy('name', 'asc')->get();
    	return view('admin.teams.index', compact('teams', 'categories', 'filterName', 'filterCategory', 'order', 'pagination'));
    }

    public function add()
    {
    	$categories = TeamCategory::orderBy('name', 'asc')->get();
    	return view('admin.teams.add', compact('categories'));
    }

    public function save(Request $request)
    {
        try{
        	$this->validate($request, [
        		'name' => 'required',
                'team_category_id' => 'required',
        		'logo' => [
        			'image',
        			'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
        		],
        	]);
        } catch(\Exception $e) {
            return back()->withInput()->with('error', 'No se han guardado los datos. Revisa los campos del formulario.');
        }

    	$team = new Team;
    	$team->fill($request->all());
        $team->slug = str_slug($request->name);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = $request->team_category_id . '_' . date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/teams');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $team->logo = 'img/teams/' . $name;
        }
    	$team->save();

        if ($team->save()) {
            event(new TeamWasSaved($team));
        }

    	if ($request->no_close) {
    		return back()->with('status', 'Nuevo equipo registrado correctamente');
    	}

    	return redirect()->route('admin.teams')->with('status', 'Nuevo equipo registrado correctamente');
    }

    public function edit($slug)
    {
        $team = Team::where('slug', $slug)->first();
        $categories = TeamCategory::orderBy('name', 'asc')->get();
        return view('admin.teams.edit', compact('team', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        try{
            $this->validate($request, [
                'name' => 'required',
                'team_category_id' => 'required',
                'logo' => [
                    'image',
                    'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
                ],
            ]);
        } catch(\Exception $e) {
            return back()->withInput()->with('error', 'No se han guardado los datos. Revisa los campos del formulario.');
        }

        $team = Team::where('slug', $slug)->first();
        $team->team_category_id = $request->team_category_id;
        $team->name = $request->name;
        $team->slug = str_slug($request->name);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = $request->team_category_id . '_' . date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/teams');
            $imagePath = $destinationPath. "/".  $name;
            if (\File::exists(public_path($team->logo))) {
               \File::delete(public_path($team->logo));
            }
            $image->move($destinationPath, $name);
            $team->logo = 'img/teams/' . $name;
        } else {
            if (!$request->old_logo) {
                if ($team->logo) {
                    if (\File::exists(public_path($team->logo))) {
                       \File::delete(public_path($team->logo));
                    }
                    $team->logo = '';
                }
            }
        }

        $team->save();

        return redirect()->route('admin.teams')->with('status', 'Cambios guardados correctamente en equipo "' . $team->name . '"');
    }

    public function duplicate($id)
    {
    	$original = Team::find($id);
    	if ($original) {
	    	$team = $original->replicate();
	    	$team->name .= " (copia)";
            $team->slug = str_slug($team->name);

            if ($team->logo) {
                $extension = strstr($team->logo, '.');
                $logo = 'img/teams/' . $team->team_category_id . '_' . date('mdYHis') . uniqid() . $extension;
                $sourceFilePath = public_path() . '/' . $team->logo;
                $destinationPath = public_path() .'/' . $logo;
                if (\File::exists($sourceFilePath)) {
                    \File::copy($sourceFilePath,$destinationPath);
                }

                $team->logo = $logo;
            }


	    	$team->save();

	    	return redirect()->route('admin.teams')->with('status', 'Se ha duplicado el equipo "' . $team->name . '" correctamente.');
	    } else {
	    	return back()->with('error', 'Acción cancelada. El equipo que quieres duplicar ya no existe.');
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
                    $extension = strstr($original->logo, '.');
                    $logo = 'img/teams/' . $original->team_category_id . '_' . date('mdYHis') . uniqid() . $extension;
                    $sourceFilePath = public_path() . '/' . $original->logo;
                    $destinationPath = public_path() .'/' . $logo;
                    if (\File::exists($sourceFilePath)) {
                        \File::copy($sourceFilePath,$destinationPath);
                    }

                    $team->logo = $logo;
                }

		    	$team->save();
		    }
    	}
    	if ($counter > 0) {
    		return redirect()->route('admin.teams')->with('status', 'Se han duplicado los equipos seleccionados correctamente.');
    	} else {
    		return back()->with('error', 'Acción cancelada. Los equipos que quieres duplicar ya no existen.');
    	}
    }

    public function destroy($id)
    {
    	$team = Team::find($id);
    	if ($team) {
	    	$name = $team->name;
            if (\File::exists(public_path($team->logo))) {
                \File::delete(public_path($team->logo));
            }
	    	$team->delete();
	    	return redirect()->route('admin.teams')->with('status', 'Se ha eliminado el equipo "' . $name . '" correctamente');
    	} else {
    		return back()->with('error', 'Acción cancelada. El equipo que quieres eliminar ya no existe.');
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
                if (\File::exists(public_path($team->logo))) {
                    \File::delete(public_path($team->logo));
                }
				$team->delete();
		    }
    	}
    	if ($counter > 0) {
    		return redirect()->route('admin.teams')->with('status', 'Se han eliminado los equipos seleccionados correctamente.');
    	} else {
    		return back()->with('error', 'Acción cancelada. Los equipos que quieres eliminar ya no existen.');
    	}
    }

    public function importFile(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = \Excel::load($path)->get();

            if ($data->count()) {
                foreach ($data as $key => $value) {
                    // try {
                        $slug = str_slug($value->name);
                        $arr[] = ['team_category_id' => $value->team_category_id, 'name' => $value->name, 'logo' => $value->logo, 'slug' => $slug];
                    // }
                    // catch (\Exception $e) {
                        // return back()->with('error', 'Fallo al importar los datos, el archivo es inválido o no tiene el formato necesario.');
                    // }
                }
                if (!empty($arr)) {
                    // try {
                        \DB::table('teams')->insert($arr);
                        return back()->with('status', 'Datos importados correctamente.');
                    // }
                    // catch (\Exception $e) {
                        // return back()->with('error', 'Fallo al importar los datos, el archivo es inválido.');
                    // }
                }
            }
        }
        return back()->with('error', 'Fallo al importar los datos, no has cargado ningún archivo válido.');
    }

	public function exportFile($type, $filterCategory=null, $filterName=null)
	{

        $teams = Team::teamCategoryId($filterCategory)->name($filterName)->orderBy('id', 'asc')->get()->toArray();
        return \Excel::create('equipos_export' . time(), function($excel) use ($teams) {
            $excel->sheet('equipos', function($sheet) use ($teams)
            {
                $sheet->fromArray($teams);
            });
        })->download($type);
    }
}
