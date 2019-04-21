<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SeasonCompetition;
use App\SeasonCompetitionPhase;

class SeasonCompetitionPhaseController extends Controller
{
    public function index($slug)
    {
        $order = request()->order;
        if (!$order) {
            $order = 'default';
        }
        $order_ext = $this->getOrder($order);

        $pagination = request()->pagination;
        if (!$pagination == null) {
            $perPage = $pagination;
        } else {
            $perPage = 12;
        }
        $page = request()->page;

        $competition = SeasonCompetition::where('slug','=', $slug)->firstOrFail();

        $phases = SeasonCompetitionPhase::where('competition_id', '=', $competition->id)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);

        return view('admin.seasons_competitions_phases.index', compact('phases', 'competition', 'order', 'pagination', 'page'));
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
            ],
        ];
        return $order_ext[$order];
    }
}
