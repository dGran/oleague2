<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonPlayer extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'season_id', 'player_id', 'participant_id', 'salary', 'price', 'active', 'transferable', 'untransferable', 'player_on_loan', 'for_sale', 'sale_price', 'sale_auto_accept'
    ];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'season_id');
    }

    public function player()
    {
        return $this->hasOne('App\Player', 'id', 'player_id');
    }

    public function participant()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_id');
    }

    public function scopeSeasonId($query, $seasonID)
    {
        if (trim($seasonID) !="") {
            $query->where("season_id", "=", $seasonID);
        }
    }

    public function scopeParticipantId($query, $participantID)
    {
        if (trim($participantID) !="") {
            $query->where("participant_id", "=", $participantID);
        }
    }

    public function allowDelete()
    {
        if ($this->participant_id > 0) {
            return false;
        }
        return true;
    }

    public function clause_price()
    {
        return $this->price * 1.10;
    }
}
