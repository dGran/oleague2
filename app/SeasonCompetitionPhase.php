<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhase extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases';

    public function competition()
    {
        return $this->hasOne('App\SeasonCompetition', 'id', 'competition_id');
    }
}
