<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\User;
use App\Team;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonParticipantController extends Controller
{
    public function index()
    {
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

        $participants = SeasonParticipant::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
    	return view('admin.seasons_participants.index', compact('participants', 'order', 'pagination'));
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

    // public function destroy($id)
    // {
    //     $category = TeamCategory::find($id);

    //     if ($category) {
    //         $message = 'Se ha eliminado la categoría "' . $category->name . '" correctamente.';

    //         event(new TableWasDeleted($category, $category->name));
    //         $category->delete();

    //         return redirect()->route('admin.teams_categories')->with('success', $message);
    //     } else {
    //         $message = 'Acción cancelada. La categoría que querías eliminar ya no existe. Se ha actualizado la lista';
    //         return back()->with('warning', $message);
    //     }
    // }

    // public function destroyMany($ids)
    // {
    //     $ids=explode(",",$ids);
    //     $counter_deleted = 0;
    //     $counter_no_allow = 0;
    //     for ($i=0; $i < count($ids); $i++)
    //     {
    //         $category = TeamCategory::find($ids[$i]);
    //         if ($category) {
    //             if (!$category->hasTeams()) {
    //                 $counter_deleted = $counter_deleted +1;
    //                 event(new TableWasDeleted($category, $category->name));
    //                 $category->delete();
    //             } else {
    //                 $counter_no_allow = $counter_no_allow +1;
    //             }
    //         }
    //     }
    //     if ($counter_deleted > 0) {
    //         if ($counter_no_allow > 0) {
    //             return redirect()->route('admin.teams_categories')->with('success', 'Se han eliminado las categorías seleccionadas correctamente excepto las que tienen equipos asociados.');
    //         } else {
    //             return redirect()->route('admin.teams_categories')->with('success', 'Se han eliminado las categorías seleccionadas correctamente.');
    //         }
    //     } else {
    //         if ($counter_no_allow > 0) {
    //             return back()->with('warning', 'Acción cancelada. No es posible eliminar las categorías seleccionadas ya que tienen equipos asociados.');
    //         } else {
    //             return back()->with('warning', 'Acción cancelada. La categorías que querías eliminar ya no existen.');
    //         }
    //     }
    // }

    // public function duplicate($id)
    // {
    //     $category = TeamCategory::find($id);

    // 	if ($category) {
	   //  	$newCategory = $category->replicate();
	   //  	$newCategory->name .= " (copia)";
    //         $newCategory->slug = str_slug($newCategory->name);

	   //  	$newCategory->save();

    //         if ($newCategory->save()) {
    //             event(new TableWasSaved($newCategory, $newCategory->name));
    //         }

	   //  	return redirect()->route('admin.teams_categories')->with('success', 'Se ha duplicado la categoría "' . $newCategory->name . '" correctamente.');
	   //  } else {
	   //  	return back()->with('warning', 'Acción cancelada. La categoría que querías duplicar ya no existe. Se ha actualizado la lista.');
	   //  }
    // }

    // public function duplicateMany($ids)
    // {
    // 	$ids=explode(",",$ids);
    // 	$counter = 0;
    // 	for ($i=0; $i < count($ids); $i++)
    // 	{
	   //  	$original = TeamCategory::find($ids[$i]);
	   //  	if ($original) {
	   //  		$counter = $counter +1;
		  //   	$category = $original->replicate();
		  //   	$category->name .= " (copia)";
    //             $category->slug = str_slug($category->name);

		  //   	$category->save();

    //             if ($category->save()) {
    //                 event(new TableWasSaved($category, $category->name));
    //             }
		  //   }
    // 	}
    // 	if ($counter > 0) {
    // 		return redirect()->route('admin.teams_categories')->with('success', 'Se han duplicado las categorías seleccionadas correctamente.');
    // 	} else {
    // 		return back()->with('warning', 'Acción cancelada. Las categorías que querías duplicar ya no existen. Se ha actualizado la lista.');
    // 	}
    // }

    // public function exportFile($filename, $type, $filterName, $order, $ids = null)
    // {
    //     if (!$order) {
    //         $order = 'default';
    //     }
    //     $order_ext = $this->getOrder($order);

    //     if ($filterName == "null") { $filterName =""; }

    //     if ($ids) {
    //         $ids = explode(",",$ids);
    //         $categories = TeamCategory::whereIn('id', $ids)
    //             ->name($filterName)
    //             ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
    //             ->get()->toArray();
    //     } else {
    //         $categories = TeamCategory::name($filterName)
    //             ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
    //             ->get()->toArray();
    //     }

    //     if (!$filename) {
    //         $filename = 'categorias_equipos_export' . time();
    //     } else {
    //         $filename = str_slug($filename);
    //     }
    //     return \Excel::create($filename, function($excel) use ($categories) {
    //         $excel->sheet('categorias_equipos', function($sheet) use ($categories)
    //         {
    //             $sheet->fromArray($categories);
    //         });
    //     })->download($type);
    // }

    // public function importFile(Request $request)
    // {
    //     if ($request->hasFile('import_file')) {
    //         $path = $request->file('import_file')->getRealPath();
    //         $data = \Excel::load($path)->get();

    //         if ($data->count()) {
    //             foreach ($data as $key => $value) {
    //                 try {
    //                     $category = new TeamCategory;
    //                     $category->name = $value->name;
    //                     $category->slug = str_slug($value->name);

    //                     if ($category) {
    //                         $category->save();
    //                         if ($category->save()) {
    //                             event(new TableWasImported($category, $category->name));
    //                         }
    //                     }
    //                 }
    //                 catch (\Exception $e) {
    //                     return back()->with('error', 'Fallo al importar los datos, el archivo es inválido o no tiene el formato necesario.');
    //                 }
    //             }
    //             return back()->with('success', 'Datos importados correctamente.');
    //         } else {
    //             return back()->with('error', 'Fallo al importar los datos, el archivo no contiene datos.');
    //         }
    //     }
    //     return back()->with('error', 'No has cargado ningún archivo.');
    // }


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
