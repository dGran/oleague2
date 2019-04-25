<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhaseGroup extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases_groups';

    protected $fillable = ['phase_id', 'name', 'num_participants', 'slug'];

    public function phase()
    {
        return $this->hasOne('App\SeasonCompetitionPhase', 'id', 'phase_id');
    }

    public function participants()
    {
        return $this->hasMany('App\SeasonCompetitionPhaseGroupParticipant', 'group_id', 'id');
    }
}
