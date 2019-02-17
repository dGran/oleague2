<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonParticipant extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'name', 'season_id', 'team_id', 'user_id', 'budget', 'paid_clauses', 'clauses_received', 'slug'
    ];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'season_id');
    }

    public function team()
    {
        return $this->hasOne('App\Team', 'id', 'team_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    // public function season()
    // {
    //     return $this->belongsTo('App\Season', 'season_id');
    // }

    public function cash_history()
    {
        return $this->hasmany('App\SeasonParticipantCashHistory', 'participant_id', 'id');
    }

    public function scopeSeasonId($query, $seasonID)
    {
        if (trim($seasonID) !="") {
            $query->where("season_id", "=", $seasonID);
        }
    }
}
