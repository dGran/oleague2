<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayOffRoundParticipant extends Model
{
	public $timestamps = false;
	protected $table = 'playoffs_rounds_participants';

    protected $fillable = ['round_id', 'participant_id'];

    public function round()
    {
        return $this->hasOne('App\PlayOffRound', 'id', 'round_id');
    }

    public function participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'participant_id');
    }
}
