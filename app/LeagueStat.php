<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueStat extends Model
{
	public $timestamps = false;
	protected $table = 'leagues_stats';

    public function league()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupLeague', 'id', 'league_id');
    }

    public function player()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player_id');
    }
}
