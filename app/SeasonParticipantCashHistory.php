<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonParticipantCashHistory extends Model
{
	protected $table = "season_participant_cash_history";

    public function participant()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_id');
    }
}
