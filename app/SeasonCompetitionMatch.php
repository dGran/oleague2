<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionMatch extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_matches';

    protected $fillable = ['day_id', 'clash_id', 'local_id', 'local_user_id', 'local_score', 'visitor_id', 'visitor_user_id', 'visitor_score', 'santioned_id', 'date_limit', 'active'];

    public function day()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupLeagueDay', 'id', 'day_id');
    }

    public function local_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'local_id');
    }

    public function visitor_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'visitor_id');
    }

    public function getDateLimit_date()
    {
        return $date = \Carbon\Carbon::parse($this->date_limit)->format('Y-m-d');
    }

    public function getDateLimit_time()
    {
        return $date = \Carbon\Carbon::parse($this->date_limit)->format('H:i');
    }

    public function match_name()
    {
        if ($this->day) {
            $competition = $this->day->league->group->phase->competition;
            $phase = $this->day->league->group->phase;
            $group = $this->day->league->group;

            $match_name = $competition->name;
            if ($competition->phases->count() > 1) {
                $match_name .= ' - ' . $phase->name;
            }
            if ($phase->groups->count() > 1) {
                $match_name .= ' - ' . $group->name;
            }
            return $match_name . ' - Jornada ' . $this->day->order;

        } else { //playoffs

        }
    }
}
