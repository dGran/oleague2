<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\PlayerDB;

use App\Team;
use App\TeamCategory;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class PlayerController extends Controller
{
    public function index()
    {
    	$filterName = request()->filterName;
    	$filterPlayerDb = request()->filterPlayerDb;
        $filterTeam = request()->filterTeam;
        $filterNation = request()->filterNation;
        $filterPosition = request()->filterPosition;
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

        $players = Player::playerDbId($filterPlayerDb)->name($filterName)->teamName($filterTeam)->nationName($filterNation)->position($filterPosition)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage);
        $players_dbs = PlayerDB::orderBy('name', 'asc')->get();
    	return view('admin.players.index', compact('players', 'players_dbs', 'filterName', 'filterPlayerDb', 'filterTeam', 'filterNation', 'filterPosition', 'order', 'pagination'));
    }

    public function add()
    {
    	$players_dbs = PlayerDB::orderBy('name', 'asc')->get();
    	return view('admin.players.add', compact('players_dbs'));
    }

    public function save()
    {
        if (request()->new_parent) {
            $data = request()->validate([
                'name' => 'required',
                'img' => [
                    'image',
                    'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
                ],
                'players_db_name' => 'required|unique:players_dbs,name',
            ],
            [
                'name.required' => 'El nombre del jugador es obligatorio',
                'players_db_name.required' => 'El nombre de la database es obligatorio',
                'players_db_name.unique' => 'El nombre de la database ya existe',
                'img.image' => 'El archivo debe contener una imagen',
                'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
            ]);

            $database = new PlayerDB;
            $database->name = request()->players_db_name;
            $database->slug = str_slug($database->name);
            $database->save();
            event(new TableWasSaved($database, $database->name));

            $players_db_id = $database->id;
        } else {
            $data = request()->validate([
                'name' => 'required',
                'players_db_id' => 'required',
                'img' => [
                    'image',
                    'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
                ],
            ],
            [
                'name.required' => 'El nombre del jugador es obligatorio',
                'players_db_id.required' => 'El player database es obligatorio',
                'img.image' => 'El archivo debe contener una imagen',
                'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
            ]);

            $players_db_id = request()->players_db_id;
        }

        $data = request()->all();
        $data['players_db_id'] = $players_db_id;
        $data['slug'] = str_slug(request()->name);

        if (request()->url_img) {
            $data['img'] = request()->img_link;
        } else {
            if (request()->hasFile('img')) {
                $image = request()->file('img');
                $name = request()->player_db_id . '_' . date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/img/players');
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
                $data['img'] = 'img/players/' . $name;
            } else {
                $data['img'] = null;
            }
        }

        $player = Player::create($data);

        if ($player->save()) {
            event(new TableWasSaved($player, $player->name));
            if (request()->no_close) {
                return back()->with('success', 'Nuevo jugador registrado correctamente');
            }
            return redirect()->route('admin.players')->with('success', 'Nuevo jugador registrado correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $player = Player::find($id);
        if ($player) {
            $players_dbs = PlayerDB::orderBy('name', 'asc')->get();
            return view('admin.players.edit', compact('player', 'players_dbs'));
        } else {
            return back()->with('warning', 'Acción cancelada. El jugador que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $player = Player::find($id);

        if ($player) {
            if (request()->new_parent) {
                $data = request()->validate([
                    'name' => 'required',
                    'img' => [
                        'image',
                        'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
                    ],
                    'players_db_name' => 'required|unique:players_dbs,name',
                ],
                [
                    'name.required' => 'El nombre del jugador es obligatorio',
                    'players_db_name.required' => 'El nombre de la database es obligatorio',
                    'players_db_name.unique' => 'El nombre de la database ya existe',
                    'img.image' => 'El archivo debe contener una imagen',
                    'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
                ]);

                $database = new PlayerDB;
                $database->name = request()->players_db_name;
                $database->slug = str_slug($database->name);
                $database->save();
                event(new TableWasSaved($database, $database->name));

                $players_db_id = $database->id;
            } else {
                $data = request()->validate([
                    'name' => 'required',
                    'players_db_id' => 'required',
                    'img' => [
                        'image',
                        'dimensions:max_width=256,max_height=256,ratio=1/1,min_width=48,min_height=48',
                    ],
                ],
                [
                    'name.required' => 'El nombre del jugador es obligatorio',
                    'players_db_id.required' => 'El player database es obligatorio',
                    'img.image' => 'El archivo debe contener una imagen',
                    'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
                ]);

                $players_db_id = request()->players_db_id;
            }

            $data = request()->all();
            $data['players_db_id'] = $players_db_id;
            $data['slug'] = str_slug(request()->name);

            if (request()->url_img) {
                $data['img'] = request()->img_link;
                if ($player->img) {
                    if (\File::exists(public_path($player->img))) {
                       \File::delete(public_path($player->img));
                    }
                }
            } else {
                if (request()->hasFile('img')) {
                    $image = request()->file('img');
                    $name = request()->players_db_id . '_' . date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/img/players');
                    $imagePath = $destinationPath. "/".  $name;
                    if (\File::exists(public_path($player->img))) {
                       \File::delete(public_path($player->img));
                    }
                    $image->move($destinationPath, $name);
                    $data['img'] = 'img/players/' . $name;
                } else {
                    if (!request()->old_img) {
                        if ($player->img) {
                            if (\File::exists(public_path($player->img))) {
                               \File::delete(public_path($player->img));
                            }
                            $data['img'] = '';
                        }
                    }
                }
            }

            $player->fill($data);
            if ($player->isDirty()) {
                $player->update($data);

                if ($player->update()) {
                    event(new TableWasUpdated($player, $player->name));
                    return redirect()->route('admin.players')->with('success', 'Cambios guardados en jugador "' . $player->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.players')->with('info', 'No se han detectado cambios en el jugador "' . $player->name . '".');

        } else {
            return redirect()->route('admin.players')->with('warning', 'Acción cancelada. El jugador que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $player = Player::find($id);

        if ($player) {
            $message = 'Se ha eliminado el jugador "' . $player->name . '" correctamente.';

            if ($player->isLocalImg()) {
                if (\File::exists(public_path($player->img))) {
                    \File::delete(public_path($player->img));
                }
            }
            event(new TableWasDeleted($player, $player->name));
            $player->delete();

            return redirect()->route('admin.players')->with('success', $message);
        } else {
            $message = 'Acción cancelada. El jugador que querías eliminar ya no existe. Se ha actualizado la lista';

            return back()->with('warning', $message);
        }
    }

    public function destroyMany($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $player = Player::find($ids[$i]);
            if ($player) {
                $counter = $counter +1;
                if ($player->isLocalImg()) {
                    if (\File::exists(public_path($player->img))) {
                        \File::delete(public_path($player->img));
                    }
                }
                event(new TableWasDeleted($player, $player->name));
                $player->delete();
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.players')->with('success', 'Se han eliminado los jugadores seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Los jugadores que querías eliminar ya no existen.');
        }
    }

    public function view($id) {
        $player = Player::find($id);
        if ($player) {
            return view('admin.players.index.view', compact('player'))->render();
        } else {
            return view('admin.players.index.view-empty')->render();
        }
    }

    public function duplicate($id)
    {
        $player = Player::find($id);

    	if ($player) {
	    	$newPlayer = $player->replicate();
	    	$newPlayer->name .= " (copia)";
            $newPlayer->slug = str_slug($newPlayer->name);

            if ($newPlayer->img) {
                if ($newPlayer->isLocalImg()) {
                    $extension = strstr($newPlayer->img, '.');
                    $img = 'img/players/' . $newPlayer->players_db_id . '_' . date('mdYHis') . uniqid() . $extension;
                    $sourceFilePath = public_path() . '/' . $newPlayer->img;
                    $destinationPath = public_path() .'/' . $img;
                    if (\File::exists($sourceFilePath)) {
                        \File::copy($sourceFilePath,$destinationPath);
                    }

                    $newPlayer->img = $img;
                }
            }

	    	$newPlayer->save();

            if ($newPlayer->save()) {
                event(new TableWasSaved($newPlayer, $newPlayer->name));
            }

	    	return redirect()->route('admin.players')->with('success', 'Se ha duplicado el jugador "' . $newPlayer->name . '" correctamente.');
	    } else {
	    	return back()->with('warning', 'Acción cancelada. El jugador que querías duplicar ya no existe. Se ha actualizado la lista.');
	    }
    }

    public function duplicateMany($ids)
    {
    	$ids=explode(",",$ids);
    	$counter = 0;
    	for ($i=0; $i < count($ids); $i++)
    	{
	    	$original = Player::find($ids[$i]);
	    	if ($original) {
	    		$counter = $counter +1;
		    	$player = $original->replicate();
		    	$player->name .= " (copia)";
                $player->slug = str_slug($player->name);

                if ($player->img) {
                    if ($player->isLocalImg()) {
                        $extension = strstr($player->img, '.');
                        $img = 'img/players/' . $player->player_category_id . '_' . date('mdYHis') . uniqid() . $extension;
                        $sourceFilePath = public_path() . '/' . $player->img;
                        $destinationPath = public_path() .'/' . $img;
                        if (\File::exists($sourceFilePath)) {
                            \File::copy($sourceFilePath,$destinationPath);
                        }

                        $player->img = $img;
                    }
                }

		    	$player->save();

                if ($player->save()) {
                    event(new TableWasSaved($player, $player->name));
                }
		    }
    	}
    	if ($counter > 0) {
    		return redirect()->route('admin.players')->with('success', 'Se han duplicado los jugadores seleccionados correctamente.');
    	} else {
    		return back()->with('warning', 'Acción cancelada. Los jugadores que querías duplicar ya no existen. Se ha actualizado la lista.');
    	}
    }

    public function exportFile($filename, $type, $filterName, $filterPlayerDb, $order, $ids = null)
    {
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        if ($filterName == "null") { $filterName =""; }
        if ($filterPlayerDb == "null") { $filterPlayerDb =""; }

        if ($ids) {
            $ids = explode(",",$ids);
            $players = Player::whereIn('id', $ids)
                ->playerDbId($filterPlayerDb)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $players = Player::playerDbId($filterPlayerDb)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if (!$filename) {
            $filename = 'jugadores_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($players) {
            $excel->sheet('jugadores', function($sheet) use ($players)
            {
                $sheet->fromArray($players);
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

                        $player = new Player;
                        $player->players_db_id = $value->players_db_id;
                        $player->game_id = $value->game_id;
                        $player->name = $value->name;
                        $player->img = $value->img;
                        $player->nation_name = $value->nation_name;
                        $player->league_name = $value->league_name;
                        $player->team_name = $value->team_name;
                        $player->position = $value->position;
                        $player->height = $value->height;
                        $player->age = $value->age;
                        $player->overall_rating = $value->overall_rating;
                        $player->slug = str_slug($value->name);

                        if ($player) {
                            $player->save();
                            if ($player->save()) {
                                event(new TableWasImported($player, $player->name));
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

    public function pesdb_importFile(Request $request)
    {
        if ($request->hasFile('import_pesdb_file')) {
            $path = $request->file('import_pesdb_file')->getRealPath();
            $data = \Excel::load($path)->get();

            if ($data->count()) {
                foreach ($data as $key => $value) {
                    try {

	                	$category = TeamCategory::where('name', '=', $value->league_name)->first();
	                	if (!$category) {
	            	        $category = TeamCategory::create([
	            				'name' => $value->league_name,
	            				'slug' => str_slug($value->league_name)
	        				]);
	                	}
	                	$team = Team::where('name', '=', $value->team_name)->first();
	                	if (!$team) {
					        $team = Team::create([
					            'team_category_id' => $category->id,
					            'name' => $value->team_name,
					            'logo' => '',
					            'slug' => str_slug($value->team_name)
					        ]);
					    }
                        $player = new Player;
                        $player->players_db_id = $value->players_db_id;
                        $player->game_id = $value->game_id;
                        $player->name = $value->name;
                        $player->img = 'https://www.pesmaster.com/pes-2019/graphics/players/player_' . $value->game_id . '.png';
                        $player->nation_name = $value->nation_name;
                        $player->league_name = $value->league_name;
                        $player->team_name = $value->team_name;
                        $player->position = $value->position;
                        $player->height = $value->height;
                        $player->age = $value->age;
                        $player->overall_rating = $value->overall_rating;
                        $player->slug = str_slug($value->name);

                        if ($player) {
                            $player->save();
                            if ($player->save()) {
                                event(new TableWasImported($player, $player->name));
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

    public function linkWebImages($www)
    {
        if ($www == 'pesdb' || $www == 'pesmaster') {
            $players = Player::where('game_id', '>', 0)->get();
            foreach ($players as $player) {
                if (!$player->isLocalImg()) {
                    if ($www == 'pesdb') {
                        $new_image = pesdb_player_img_path($player->game_id);
                    } else {
                        $new_image = pesmaster_player_img_path($player->game_id);
                    }
                    $player->img = $new_image;
                    $player->save();
                }
            }
        } else {
            return back()->with('error', 'No se ha especificado el servidor de imágenes.');
        }

        return back()->with('success', 'Imágenes enlazadas correctamente.');
    }

    public function unlinkWebImages()
    {
        $players = Player::where('game_id', '>', 0)->get();
        foreach ($players as $player) {
            if (!$player->isLocalImg()) {
                $player->img = '';
                $player->save();
            }
        }

        return back()->with('success', 'Imágenes desenlazadas correctamente.');
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
