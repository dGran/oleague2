<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetition extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'season_id', 'name', 'logo'
    ];

    public function scopeSeasonId($query, $seasonID)
    {
        if (trim($seasonID) !="") {
            $query->where("season_id", "=", $seasonID);
        }
    }
}
