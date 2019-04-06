<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminFilter;
use App\Season;
use App\SeasonCompetition;

class SeasonCompetitionController extends Controller
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
                if ($admin->seasonCompetitions_page) {
                    $page = $admin->seasonCompetitions_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->seasonCompetitions_filterSeason) {
                    if (Season::find($admin->seasonCompetitions_filterSeason)) {
                        $filterSeason = $admin->seasonCompetitions_filterSeason;
                    }
                }
                if ($admin->seasonCompetitions_order) {
                    $order = $admin->seasonCompetitions_order;
                }
                if ($admin->seasonCompetitions_pagination) {
                    $pagination = $admin->seasonCompetitions_pagination;
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
        $adminFilter->seasonCompetitions_filterSeason = $filterSeason;
        $adminFilter->seasonCompetitions_order = $order;
        $adminFilter->seasonCompetitions_pagination = $pagination;
        $adminFilter->seasonCompetitions_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('seasonCompetitions_page')) {
            $page = 1;
            $adminFilter->seasonCompetitions_page = $page;
        }
        $adminFilter->save();

        $active_season = Season::find($filterSeason);

        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }

        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);


        $competitions = SeasonCompetition::seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        $seasons = Season::orderBy('name', 'asc')->get();
        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
            $competitions = SeasonCompetition::seasonId($filterSeason)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
            $adminFilter->seasonCompetitions_page = $page;
            $adminFilter->save();
        }

        return view('admin.seasons_competitions.index', compact('competitions', 'seasons', 'filterSeason', 'active_season', 'order', 'pagination', 'page'));
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
                'sortField'     => 'team_name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'team_name',
                'sortDirection' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }
}
