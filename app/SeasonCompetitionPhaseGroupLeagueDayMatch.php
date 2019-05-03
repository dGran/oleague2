<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhaseGroupLeagueDayMatch extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases_groups_leagues_days_matches';

    protected $fillable = ['day_id', 'local_id', 'local_user_id', 'local_score', 'visitor_id', 'visitor_user_id', 'visitor_score', 'santioned_id', 'date_limit', 'active'];

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
}
