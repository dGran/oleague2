<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonParticipant extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'season_id', 'team_id', 'user_id', 'paid_clauses', 'clauses_received'
    ];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'season_id');
    }

    public function team()
    {
        return $this->hasOne('App\Team', 'id', 'team_id');
    }

    public function players()
    {
        return $this->hasmany('App\SeasonPlayer', 'participant_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function cash_history()
    {
        return $this->hasmany('App\SeasonParticipantCashHistory', 'participant_id', 'id');
    }

    public function scopeSeasonId($query, $seasonID)
    {
        if (trim($seasonID) !="") {
            $query->where("season_id", "=", $seasonID);
        }
    }

    public function budget() {
        $budget = 0;
        foreach ($this->cash_history as $cash_history) {
            if ($cash_history->movement == 'E') {
                $budget = $budget + $cash_history->amount;
            } elseif ($cash_history->movement == 'S') {
                $budget = $budget - $cash_history->amount;
            }
        }
        return $budget;
    }

    public function budget_formatted() {
        return $this->budget() . " M";
    }

    public function salaries() {
        $salaries = 0;
        foreach ($this->players as $player) {
            $salaries = $salaries + $player->salary;
        }
        return $salaries;
    }

    public function salaries_formatted() {
        return $this->salaries() . " M";
    }

    public function salaries_avg() {
        if ($this->players->count() > 0) {
            return $this->salaries() / $this->players->count();
        }
        return '0';
    }

    public function logo() {
        if ($this->season->participant_has_team) {
            if ($this->team_id) {
                return $this->team->getLogoFormatted();
            } else {
                return asset('img/team_no_image.png');
            }
        } else {
            if ($this->user_id) {
                return $this->user->avatar();
            } else {
                return asset('img/user_unknown.png');
            }
        }
    }

    public function name() {
        if ($this->season->participant_has_team) {
            if ($this->team_id) {
                return $this->team->name;
            } else {
                return "undefined";
            }
        } else {
            if ($this->user_id) {
                return $this->user->name;
            } else {
                return "undefined";
            }
        }
    }

    public function sub_name() {
        if ($this->season->participant_has_team) {
            if ($this->user_id) {
                return $this->user->name;
            } else {
                return "undefined";
            }
        } else {
            return "";
        }
    }

    public function team_avg_overall() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('players.overall_rating')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->avg('players.overall_rating');
    }

    public function team_avg_age() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('players.age')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->avg('players.age');
    }

    public function top_players() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();
    }

    public function top_defs() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->where(function($q) {
                $q->where('players.position', '=', 'CT')
                  ->orWhere('players.position', '=', 'LI')
                  ->orWhere('players.position', '=', 'LD')
                  ->orWhere('players.position', '=', 'LD');
            })
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();
    }

    public function top_mids() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->where(function($q) {
                $q->where('players.position', '=', 'MCD')
                  ->orWhere('players.position', '=', 'MC')
                  ->orWhere('players.position', '=', 'MP')
                  ->orWhere('players.position', '=', 'II')
                  ->orWhere('players.position', '=', 'ID');
            })
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();
    }

    public function top_forws() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->where(function($q) {
                $q->where('players.position', '=', 'DC')
                  ->orWhere('players.position', '=', 'SD')
                  ->orWhere('players.position', '=', 'EI')
                  ->orWhere('players.position', '=', 'ED');
            })
            ->orderBy('players.overall_rating', 'desc')
            ->take(3)->get();
    }

    public function young_players() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->orderBy('players.age', 'asc')
            ->take(3)->get();
    }

    public function veteran_players() {
        return SeasonPlayer::
            leftJoin('players', 'players.id', '=', 'season_players.player_id')
            ->select('season_players.*')
            ->seasonId(active_season()->id)
            ->where('participant_id', '=', $this->id)
            ->orderBy('players.age', 'desc')
            ->take(3)->get();
    }

    public function last_results() {

        return SeasonCompetitionPhaseGroupLeagueDayMatch::
            where(function($q) {
                $q->whereNotNull('local_score')
                  ->whereNotNull('visitor_score');
            })
            // ->where(function($q) {
            //     $q->where('local_user_id', '=', $this->user->id)
            //       ->OrWhere('visitor_user_id', '=', $this->user->id);
            // })
            ->take(3)->get();

            //falta el orden por partido registrado, es decir updated_at
            //y faltaria obtener los resultados por participante, no por usuario
    }

}
