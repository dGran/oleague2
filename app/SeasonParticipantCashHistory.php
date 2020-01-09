<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonParticipantCashHistory extends Model
{
	protected $table = "season_participant_cash_history";

    protected $fillable = [
        'participant_id', 'description', 'amount', 'movement'
    ];

    public function participant()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_id');
    }

    public function scopeParticipantId($query, $participantID)
    {
        if (trim($participantID) !="") {
            $query->where("participant_id", "=", $participantID);
        }
    }
}
