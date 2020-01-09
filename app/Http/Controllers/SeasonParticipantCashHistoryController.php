<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonParticipant;
use App\SeasonParticipantCashHistory;
use App\User;
use App\Season;
use App\AdminFilter;

use App\Events\TableWasSaved;
use App\Events\TableWasDeleted;
use App\Events\TableWasUpdated;
use App\Events\TableWasImported;

use Telegram\Bot\Laravel\Facades\Telegram;

class SeasonParticipantCashHistoryController extends Controller
{
    public function index()
    {
    	if (request()->filterParticipant == NULL) { request()->filterParticipant = 0; }

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
            $filterParticipant = request()->filterParticipant;
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
            if (!$page) {
                if ($admin->seasonCashHistory_page) {
                    $page = $admin->seasonCashHistory_page;
                }
            }

            if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
                if ($admin->seasonCashHistory_filterSeason) {
                    if (Season::find($admin->seasonCashHistory_filterSeason)) {
                        $filterSeason = $admin->seasonCashHistory_filterSeason;
                    }
                }
                if ($admin->seasonPlayers_filterParticipant) {
                    $filterParticipant = $admin->seasonCashHistory_filterParticipant;
                }
                if ($admin->seasonCashHistory_order) {
                    $order = $admin->seasonCashHistory_order;
                }
                if ($admin->seasonCashHistory_pagination) {
                    $pagination = $admin->seasonCashHistory_pagination;
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
            $filterParticipant = request()->filterParticipant;
            $order = request()->order;
            $pagination = request()->pagination;
            $page = request()->page;
        }


        $adminFilter = AdminFilter::find($admin->id);
        $adminFilter->seasonCashHistory_filterSeason = $filterSeason;
        $adminFilter->seasonCashHistory_filterParticipant = $filterParticipant;
        $adminFilter->seasonCashHistory_order = $order;
        $adminFilter->seasonCashHistory_pagination = $pagination;
        $adminFilter->seasonCashHistory_page = $page;
        if ($adminFilter->isDirty() && !$adminFilter->isDirty('seasonCashHistory_page')) {
            $page = 1;
            $adminFilter->seasonCashHistory_page = $page;
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

        if ($filterParticipant >= 0) {
            $cash_histories = SeasonParticipantCashHistory::participantId($filterParticipant)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        } else {
        	$cash_histories = SeasonParticipantCashHistory::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
        }

        $seasons = Season::orderBy('name', 'asc')->get();
        if (Season::find($filterSeason)->participant_has_team) {
            $participants = SeasonParticipant::
            leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
            ->select('season_participants.*', 'teams.name as team_name')
            ->seasonId($filterSeason)->orderBy('team_name', 'asc')->get();
        } else {
            $participants = SeasonParticipant::
            leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'users.name as user_name')
            ->seasonId($filterSeason)->orderBy('user_name', 'asc')->get();
        }

        if ($seasons->count() == 0) {
            if ($page-1 > 0) {
                $page = $page-1;
            } else {
                $page = 1;
            }
	        if ($filterParticipant >= 0) {
	            $cash_histories = SeasonParticipantCashHistory::$cash_histories->participantId($filterParticipant)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
	        } else {
	        	$cash_histories = SeasonParticipantCashHistory::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->paginate($perPage, ['*'], 'page', $page);
	        }

            $adminFilter->seasonCashHistory_page = $page;
            $adminFilter->save();
        }

        return view('admin.cash_history.index', compact('cash_histories', 'seasons', 'participants', 'filterSeason', 'filterParticipant', 'active_season', 'order', 'pagination', 'page'));
    }

    public function add($season_id)
    {
        $season = Season::find($season_id);
        if ($season->participant_has_team) {
            $participants = SeasonParticipant::
            leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
            ->select('season_participants.*', 'teams.name as team_name')
            ->seasonId($season->id)->orderBy('team_name', 'asc')->get();
        } else {
            $participants = SeasonParticipant::
            leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'users.name as user_name')
            ->seasonId($season->id)->orderBy('user_name', 'asc')->get();
        }
    	return view('admin.cash_history.add', compact('season', 'participants'));
    }

    public function save()
    {
        $data = request()->all();
        if ($data['participant_id'] == 0) {
            $participants = SeasonParticipant::seasonId($data['season_id'])->get();
            foreach ($participants as $participant) {
                $data['participant_id'] = $participant->id;
				$cash = SeasonParticipantCashHistory::create($data);
				event(new TableWasSaved($cash, $cash->description));
				if ($data['slack'] == 'on') {
			    	if ($data['movement'] == 'E') {
			    		$action = 'ingresa';
			    	} else {
			    		$action = 'desembolsa';
			    	}
			    	$text = "\xF0\x9F\x92\xB2" . $participant->team->name . " (" . $participant->user->name . ") <b>" . $action . "</b> " . number_format($data['amount'], 2, ",", ".") . " mill. por " . "'<i>" . $data['description'] . "'</i>\n" . "Presupuesto " . $participant->team->name . ": " . number_format($participant->budget(), 2, ",", ".") . " mill.";
					Telegram::sendMessage([
					    'chat_id' => '-1001241759649',
					    'parse_mode' => 'HTML',
					    'text' => $text
					]);
				}
            }
            if (request()->no_close) {
                return back()->with('success', 'Nuevos registros registrados correctamente');
            }
            return redirect()->route('admin.season_cash_history')->with('success', 'Nuevos registros registrados correctamente');
        } else {
	        $cash = SeasonParticipantCashHistory::create($data);
            $participant = SeasonParticipant::find($data['participant_id']);

	        if ($cash->save()) {
	            event(new TableWasSaved($cash, $cash->description));
				if ($data['slack'] == 'on') {
			    	if ($data['movement'] == 'E') {
			    		$action = 'ingresa';
			    	} else {
			    		$action = 'desembolsa';
			    	}
			    	$text = "\xF0\x9F\x92\xB2" . $participant->team->name . " (" . $participant->user->name . ") <b>" . $action . "</b> " . number_format($data['amount'], 2, ",", ".") . " mill. por " . "'<i>" . $data['description'] . "'</i>\n" . "Presupuesto " . $participant->team->name . ": " . number_format($participant->budget(), 2, ",", ".") . " mill.";
					Telegram::sendMessage([
					    'chat_id' => '-1001241759649',
					    'parse_mode' => 'HTML',
					    'text' => $text
					]);
				}
	            if (request()->no_close) {
	                return back()->with('success', 'Nuevo registro registrado correctamente');
	            }
	            return redirect()->route('admin.season_cash_history')->with('success', 'Nuevo registro registrado correctamente');
	        } else {
	            return back()->with('error', 'No se han guardado los datos, se ha producido un error en el servidor.');
	        }
        }
    }

    public function edit($id)
    {
        $cash = SeasonParticipantCashHistory::find($id);
        $season = $cash->participant->season;

        if ($season->participant_has_team) {
            $participants = SeasonParticipant::
            leftJoin('teams', 'teams.id', '=', 'season_participants.team_id')
            ->select('season_participants.*', 'teams.name as team_name')
            ->seasonId($season->id)->orderBy('team_name', 'asc')->get();
        } else {
            $participants = SeasonParticipant::
            leftJoin('users', 'users.id', '=', 'season_participants.user_id')
            ->select('season_participants.*', 'users.name as user_name')
            ->seasonId($season->id)->orderBy('user_name', 'asc')->get();
        }
        if ($cash) {
            return view('admin.season_cash_history.edit', compact('season', 'cash', 'participants'));
        } else {
            return back()->with('warning', 'Acción cancelada. El registro que querías editar ya no existe. Se ha actualizado la lista');
        }
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
                'sortField'     => 'created_at',
                'sortDirection' => 'asc'
            ],
            'date_desc' => [
                'sortField'     => 'created_at',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}
