<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhaseGroupLeagueDay extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases_groups_leagues_days';

    protected $fillable = ['league_id', 'order', 'date_limit', 'active'];

    public function league()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupLeague', 'id', 'league_id');
    }

    public function matches()
    {
        return $this->hasMany('App\SeasonCompetitionMatch', 'day_id', 'id');
    }

    public function day_name()
    {
        $competition = $this->league->group->phase->competition;
        $phase = $this->league->group->phase;
        $group = $this->league->group;

        $day_name = $competition->name;
        if ($competition->phases->count() > 1) {
            $day_name .= ' - ' . $phase->name;
        }
        if ($phase->groups->count() > 1) {
            $day_name .= ' - ' . $group->name;
        }
        return $day_name . ' - Jornada ' . $this->order;
    }
}
