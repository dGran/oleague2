<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayOffRound extends Model
{
	public $timestamps = false;
	protected $table = 'playoffs_rounds';

    protected $fillable = ['playoff_id', 'name', 'num_participants', 'order', 'round_trip', 'double_value', 'date_limit', 'play_amount', 'win_amount', 'lose_amount'];

    public function playoff()
    {
        return $this->hasOne('App\PlayOff', 'id', 'playoff_id');
    }

    public function clashes()
    {
        return $this->hasMany('App\PlayOffRoundClash', 'round_id', 'id');
    }

    public function participants()
    {
        return $this->hasMany('App\PlayOffRoundParticipant', 'round_id', 'id');
    }

    public function getDateLimit_date()
    {
        return $date = \Carbon\Carbon::parse($this->date_limit)->format('Y-m-d');
    }

    public function getDateLimit_time()
    {
        return $date = \Carbon\Carbon::parse($this->date_limit)->format('H:i');
    }

    public function is_last_round()
    {
        $last_round = PlayOffRound::where('playoff_id', $this->playoff_id)->orderBy('id', 'desc')->first();
        if ($last_round->id == $this->id) {
            return true;
        } else {
            return false;
        }
    }

    public function next_round()
    {
        $next_round_order = $this->order + 1;
        $next_round = PlayOffRound::where('playoff_id', $this->playoff_id)->where('order', '=', $next_round_order)->first();
        if ($next_round) {
            return $next_round;
        } else {
            return false;
        }
    }

    public function exists_matches()
    {
        $matches = 0;
        foreach ($this->clashes as $clash) {
            if ($clash->matches->count()>0) {
                $matches++;
            }
        }
        if ($matches > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function num_matches_count()
    {
        $matches = 0;
        foreach ($this->clashes as $clash) {
            $matches += $clash->matches->count();
        }
        return $matches;
    }
}
