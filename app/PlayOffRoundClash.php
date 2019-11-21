<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayOffRoundClash extends Model
{
	public $timestamps = false;
	protected $table = 'playoffs_rounds_clashes';

    protected $fillable = ['round_id', 'order', 'local_id', 'local_user_id', 'local_socre', 'visitor_id', 'visitor_user_id', 'visitor_score', 'sanctioned_id', 'table_position', 'clash_destiny_id', 'clash_destiny_position', 'date_limit', 'active'];

    public function round()
    {
        return $this->hasOne('App\PlayOffRound', 'id', 'round_id');
    }

    public function local_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'local_id');
    }

    public function visitor_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'visitor_id');
    }

    public function local_participant_name()
    {
        if ($this->local_participant) {
            return $this->local_participant->participant->name();
        } else {
            return "No definido";
        }
    }

    public function visitor_participant_name()
    {
        if ($this->visitor_participant) {
            return $this->visitor_participant->participant->name();
        } else {
            return "No definido";
        }
    }
}
