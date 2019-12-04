<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayOffStat extends Model
{
	public $timestamps = false;
	protected $table = 'playoffs_stats';

    public function playoff()
    {
        return $this->hasOne('App\PlayOff', 'id', 'playoff_id');
    }

    public function player()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player_id');
    }
}
