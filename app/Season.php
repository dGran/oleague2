<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'num_participants', 'participant_has_team', 'use_economy', 'use_rosters', 'initial_budget'
    ];

	public function scopeName($query, $name)
	{
		if (trim($name) !="") {
			$query->where("name", "LIKE", "%$name%");
		}
	}

    public function participants()
    {
        return $this->hasmany('App\SeasonParticipant', 'season_id', 'id');
    }

    public function hasParticipants()
    {
    	if ($this->participants) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
