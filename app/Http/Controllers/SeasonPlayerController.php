<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\SeasonPlayer;
use App\Player;
use App\AdminFilter;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

class SeasonPlayerController extends Controller
{
    public function index()
    {
        $admin = AdminFilter::where('user_id', '=', \Auth::user()->id)->first();
        if ($admin) {
            if (request()->filterSeason == null) {
                if (active_season()) {
                    $filterSeason = active_season()->id;
                } else {
                    $seasons = Season::all();
                    if ($seasons->isNotEmpty()) {
                        $filterSeason = $seasons->last()->id;
                    } else {
                        $filterSeason = '';
                    }
                }
            } else {
                $filterSeason = request()->filterSeason;
            }
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
            if (!$page) {
                if ($admin->seasonPlayers_page) {
                    $page = $admin->seasonPlayers_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->seasonPlayers_filterSeason) {
                    if (Season::find($admin->seasonPlayers_filterSeason)) {
                        $filterSeason = $admin->seasonPlayers_filterSeason;
                    }
                }
                if ($admin->seasonPlayers_order) {
                    $order = $admin->seasonPlayers_order;
                }
                if ($admin->seasonPlayers_pagination) {
                    $pagination = $admin->seasonPlayers_pagination;
                }
            }
        } else {
            $admin = AdminFilter::create([
                'user_id' => \Auth::user()->id,
            ]);
            if (request()->filterSeason == null) {
                if (active_season()) {
                    $filterSeason = active_season()->id;
                } else {
                    $seasons = Season::all();
                    if ($seasons->isNotEmpty()) {
                        $filterSeason = $seasons->last()->id;
                    } else {
                        $filterSeason = '';
                    }
                }
            } else {
                $filterSeason = request()->filterSeason;
            }
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
        }


        $adminFilter = AdminFilter::find($admin->id);
        $adminFilter->seasonPlayers_filterSeason = $filterSeason;
        $adminFilter->seasonPlayers_order = $order;
        $adminFilter->seasonPlayers_pagination = $pagination;
        $adminFilter->seasonPlayers_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('seasonPlayers_page')) {
            $page = 1;
            $adminFilter->seasonPlayers_page = $page;
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

        $active_season = Season::find($filterSeason);

        $players = SeasonPlayer::seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        $seasons = Season::orderBy('name', 'asc')->get();
        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $players = SeasonPlayer::seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->seasonPlayers_page = $page;
            $adminFilter->save();
        }
        return view('admin.seasons_players.index', compact('players', 'seasons', 'filterSeason', 'active_season', 'order', 'pagination', 'page'));
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
                'sortField'     => 'players.name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'players.name',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }

}