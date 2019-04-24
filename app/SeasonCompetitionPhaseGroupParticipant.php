<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhaseGroupParticipant extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases_groups_participants';

    protected $fillable = ['group_id', 'participant_id'];

    public function group()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroup', 'id', 'group_id');
    }

    public function participant()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_id');
    }
}
