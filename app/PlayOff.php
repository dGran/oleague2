<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayOff extends Model
{
	public $timestamps = false;
	protected $table = 'playoffs';

    protected $fillable = ['group_id', 'predefined_rounds', 'rounds', 'stats_mvp', 'stats_goals', 'stats_assists', 'stats_yellow_cards', 'stats_red_cards'];

    public function group()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroup', 'id', 'group_id');
    }

    public function rounds()
    {
        return $this->hasMany('App\PlayOffRound', 'playoff_id', 'id');
    }
}
