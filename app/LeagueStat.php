<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueStat extends Model
{
	public $timestamps = false;
	protected $table = 'leagues_stats';

    public function league()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupLeague', 'id', 'league_id');
    }

    public function match()
    {
        return $this->hasOne('App\SeasonCompetitionMatch', 'id', 'match_id');
    }

    public function player()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player_id');
    }

    public function is_player_local()
    {
        if ($this->match->local_participant->participant->id == $this->player->participant_id) {
            return true;
        } else {
            return false;
        }
    }

    public function is_player_visitor()
    {
        if ($this->match->visitor_participant->participant->id == $this->player->participant_id) {
            return true;
        } else {
            return false;
        }
    }
}
