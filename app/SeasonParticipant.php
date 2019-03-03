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

}
