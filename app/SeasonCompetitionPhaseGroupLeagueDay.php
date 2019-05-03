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
        return $this->hasMany('App\SeasonCompetitionPhaseGroupLeagueDayMatch', 'day_id', 'id');
    }
}
