<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayOffRoundParticipant extends Model
{
	public $timestamps = false;
	protected $table = 'playoffs_rounds_participants';

    public function round()
    {
        return $this->hasOne('App\PlayOffRound', 'id', 'round_id');
    }

    public function participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'participant_id');
    }

    public function exist_in_next_round()
    {
        $exist_participant = PlayOffRoundParticipant::where('round_id', '=', $this->round->next_round()->id)->where('participant_id', '=', $this->participant_id)->first();
        if ($exist_participant == null) {
            return false;
        } else {
            return true;
        }
    }
}
