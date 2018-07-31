<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\TeamCategory;

class TeamController extends Controller
{
    public function index(Request $request)
    {
    	$teams = Team::teamCategoryId($request->filterCategory)->name($request->filterName)->orderBy('id', 'desc')->paginate();
    	$categories = TeamCategory::orderBy('name', 'asc')->get();
    	$filterName = $request->get('filterName');
    	$filterCategory = $request->get('filterCategory');
    	return view('admin.teams.index', compact('teams', 'categories', 'filterName', 'filterCategory'));
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
        		// 'avatar' => [
        		// 	'image',
        		// 	'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
        		// ],
        	]);
        } catch(\Exception $e) {
            return back()->with('error', 'No se han guardado los datos. Revisa los campos del formulario.');
        }

    	$team = new Team;
    	$team->fill($request->all());
    	$team->save();

    	if ($request->no_close) {
    		return back()->with('status', 'Nuevo equipo registrado correctamente');
    	}

    	return redirect()->route('admin.teams')->with('status', 'Nuevo equipo registrado correctamente');
    }

    public function duplicate($id)
    {
    	$original = Team::find($id);
    	if ($original) {
	    	$team = $original->replicate();
	    	$team->name .= " (copia)";
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
        if ($request->hasFile('sample_file')) {
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();

            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $arr[] = ['title' => $value->title, 'body' => $value->body];
                }
                if (!empty($arr)) {
                    DB::table('teams')->insert($arr);
                    dd('Insert Recorded successfully.');
                }
            }
        }
        dd('Request data does not have any files to import.');
    }

	public function exportFile($type, $filterCategory=null, $filterName=null)
	{

        $teams = Team::teamCategoryId($filterCategory)->name($filterName)->orderBy('id', 'desc')->get()->toArray();
        return \Excel::create('equipos_export' . time(), function($excel) use ($teams) {
            $excel->sheet('equipos', function($sheet) use ($teams)
            {
                $sheet->fromArray($teams);
            });
        })->download($type);
    }
}
