<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\AdminFilter;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class GameController extends Controller
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
                if ($admin->game_page) {
                    $page = $admin->game_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->game_filterName) {
                    $filterName = $admin->game_filterName;
                }
                if ($admin->game_order) {
                    $order = $admin->game_order;
                }
                if ($admin->game_pagination) {
                    $pagination = $admin->game_pagination;
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
        $adminFilter->game_filterName = $filterName;
        $adminFilter->game_order = $order;
        $adminFilter->game_pagination = $pagination;
        $adminFilter->game_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('game_page')) {
            $page = 1;
            $adminFilter->game_page = $page;
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


        $games = Game::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        if ($games->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $games = Game::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->game_page = $page;
            $adminFilter->save();
        }
        return view('admin.games.index', compact('games', 'filterName', 'order', 'pagination', 'page'));
    }

    public function add()
    {
        return view('admin.games.add');
    }

    public function save()
    {
        $data = request()->validate([
            'name' => 'required|unique:games,name',
            'img' => [
                'image',
                'dimensions:max_width=512,max_height=512,min_width=96,min_height=96',
            ],
        ],
        [
            'name.required' => 'El nombre del juego es obligatorio',
            'name.unique' => 'El nombre del juego ya existe',
            'img.image' => 'El archivo debe contener una imagen',
            'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
        ]);

        $data['slug'] = str_slug(request()->name);

        if (request()->hasFile('img')) {
            $image = request()->file('img');
            $name = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/games');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $data['img'] = 'img/games/' . $name;
        } else {
            $data['img'] = null;
        }

        $game = Game::create($data);

        if ($game->save()) {
            event(new TableWasSaved($game, $game->name));
            if (request()->no_close) {
                return back()->with('success', 'Nuevo juego registrado correctamente');
            }
            return redirect()->route('admin.games')->with('success', 'Nuevo juego registrado correctamente');
        } else {
            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
        }
    }

    public function edit($id)
    {
        $game = Game::find($id);
        if ($game) {
            return view('admin.games.edit', compact('game'));
        } else {
            return back()->with('warning', 'Acción cancelada. El juego que querías editar ya no existe. Se ha actualizado la lista');
        }
    }

    public function update($id)
    {
        $game = Game::find($id);

        if ($game) {

            $data = request()->validate([
                'name' => 'required|unique:games,name,' .$game->id,
                'img' => [
                    'image',
                    'dimensions:max_width=512,max_height=512,min_width=96,min_height=96',
                ],
            ],
            [
                'name.required' => 'El nombre del juego es obligatorio',
                'name.unique' => 'El nombre del juego ya existe',
                'img.image' => 'El archivo debe contener una imagen',
                'img.dimensions' => 'Las dimensiones de la imagen no son válidas'
            ]);

            $data['slug'] = str_slug(request()->name);

            if (request()->hasFile('img')) {
                $image = request()->file('img');
                $name = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/img/games');
                $imagePath = $destinationPath. "/".  $name;
                if (\File::exists(public_path($game->img))) {
                   \File::delete(public_path($game->img));
                }
                $image->move($destinationPath, $name);
                $data['img'] = 'img/games/' . $name;
            } else {
                if (!request()->old_img) {
                    if ($game->img) {
                        if (\File::exists(public_path($game->img))) {
                           \File::delete(public_path($game->img));
                        }
                        $data['img'] = '';
                    }
                }
            }

            $game->fill($data);
            if ($game->isDirty()) {
                $game->update($data);

                if ($game->update()) {
                    event(new TableWasUpdated($game, $game->name));
                    return redirect()->route('admin.games')->with('success', 'Cambios guardados en juego "' . $game->name . '" correctamente.');
                } else {
                    return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
                }
            }

            return redirect()->route('admin.games')->with('info', 'No se han detectado cambios en el juego "' . $game->name . '".');

        } else {
            return redirect()->route('admin.games')->with('warning', 'Acción cancelada. El juego que estabas editando ya no existe. Se ha actualizado la lista');
        }

    }

    public function destroy($id)
    {
        $game = Game::find($id);

        if ($game) {
            $message = 'Se ha eliminado el juego "' . $game->name . '" correctamente.';

            if ($game->isLocalImg()) {
                if (\File::exists(public_path($game->img))) {
                    \File::delete(public_path($game->img));
                }
            }
            event(new TableWasDeleted($game, $game->name));
            $game->delete();

            return redirect()->route('admin.games')->with('success', $message);
        } else {
            $message = 'Acción cancelada. El juego que querías eliminar ya no existe. Se ha actualizado la lista';

            return back()->with('warning', $message);
        }
    }

    public function destroyMany($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $game = Game::find($ids[$i]);
            if ($game) {
                $counter = $counter +1;
                if ($game->isLocalImg()) {
                    if (\File::exists(public_path($game->img))) {
                        \File::delete(public_path($game->img));
                    }
                }
                event(new TableWasDeleted($game, $game->name));
                $game->delete();
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.games')->with('success', 'Se han eliminado los juegos seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. los juegos que querías eliminar ya no existen.');
        }
    }

    public function duplicate($id)
    {
        $game = Game::find($id);

        if ($game) {
            $newGame = $game->replicate();
            $newGame->name .= " (copia)";
            $newGame->slug = str_slug($newGame->name);

            if ($newGame->img) {
                if ($newGame->isLocalImg()) {
                    $extension = strstr($newGame->img, '.');
                    $img = 'img/games/' . date('mdYHis') . uniqid() . $extension;
                    $sourceFilePath = public_path() . '/' . $newGame->img;
                    $destinationPath = public_path() .'/' . $img;
                    if (\File::exists($sourceFilePath)) {
                        \File::copy($sourceFilePath,$destinationPath);
                    }

                    $newGame->img = $img;
                }
            }

            $newGame->save();

            if ($newGame->save()) {
                event(new TableWasSaved($newGame, $newGame->name));
            }

            return redirect()->route('admin.games')->with('success', 'Se ha duplicado el juego"' . $newGame->name . '" correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. El juego que querías duplicar ya no existe. Se ha actualizado la lista.');
        }
    }

    public function duplicateMany($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Game::find($ids[$i]);
            if ($original) {
                $counter = $counter +1;
                $game = $original->replicate();
                $game->name .= " (copia)";
                $game->slug = str_slug($game->name);

                if ($game->img) {
                    if ($game->isLocalimg()) {
                        $extension = strstr($game->img, '.');
                        $img = 'img/games/' . date('mdYHis') . uniqid() . $extension;
                        $sourceFilePath = public_path() . '/' . $game->img;
                        $destinationPath = public_path() .'/' . $img;
                        if (\File::exists($sourceFilePath)) {
                            \File::copy($sourceFilePath,$destinationPath);
                        }

                        $game->img = $img;
                    }
                }

                $game->save();

                if ($game->save()) {
                    event(new TableWasSaved($game, $game->name));
                }
            }
        }
        if ($counter > 0) {
            return redirect()->route('admin.games')->with('success', 'Se han duplicado los juegos seleccionados correctamente.');
        } else {
            return back()->with('warning', 'Acción cancelada. Los juegos que querías duplicar ya no existen. Se ha actualizado la lista.');
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
            $games = Game::whereIn('id', $ids)
                ->name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        } else {
            $games = Game::name($filterName)
                ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])
                ->get()->toArray();
        }

        if ($filename == null) {
            $filename = 'marcado_de_zonas_export' . time();
        } else {
            $filename = str_slug($filename);
        }
        return \Excel::create($filename, function($excel) use ($games) {
            $excel->sheet('marcado_de_zonas', function($sheet) use ($games)
            {
                $sheet->fromArray($games);
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
                        $game = new Game;
                        $game->name = $value->name;
                        $game->img = $value->img;
                        $game->slug = str_slug($value->name);

                        if ($game) {
                            $game->save();
                            if ($game->save()) {
                                event(new TableWasImported($game, $game->name));
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