<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionMatch extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_matches';

    protected $fillable = ['day_id', 'clash_id', 'local_id', 'local_user_id', 'local_score', 'visitor_id', 'visitor_user_id', 'visitor_score', 'santioned_id', 'date_limit', 'active'];

    public function day()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupLeagueDay', 'id', 'day_id');
    }

    public function clash()
    {
        return $this->hasOne('App\PlayOffRoundClash', 'id', 'clash_id');
    }

    public function competition() {
        if ($this->day_id) {
            return $this->day->league->group->phase->competition;
        } else {
            return $this->day->playoff->group->phase->competition;
        }
    }

    public function stats()
    {
        return $this->hasMany('App\LeagueStat', 'match_id', 'id');
    }

    public function local_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'local_id');
    }

    public function visitor_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'visitor_id');
    }

    public function sanctioned_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'sanctioned_id');
    }

    public function getDateLimit_date()
    {
        return $date = \Carbon\Carbon::parse($this->date_limit)->format('Y-m-d');
    }

    public function getDateLimit_time()
    {
        return $date = \Carbon\Carbon::parse($this->date_limit)->format('H:i');
    }

    public function winner()
    {
        if ($this->local_score && $this->visitor_score) {
            if ($this->local_score > $this->visitor_score) {
                return $this->local_participant->participant->id;
            } elseif ($this->visitor_score > $this->local_score) {
                return $this->visitor_participant->participant->id;
            } else {
                return null;
            }
        } else {
            return -1;
        }
    }

    public function player_match_stats($player_id) {
        return $stats = LeagueStat::where('match_id', '=', $this->id)->where('player_id', '=', $player_id)->first();
    }

    public function local_own_goals() {
        $goals = LeagueStat::where('match_id', '=', $this->id)->where('goals', '>', 0)->get();
        $local_goals = 0;

        foreach ($goals as $goal) {
            if ($goal->player->participant->id == $this->local_participant->participant->id) {
                $local_goals += $goal->goals;
            }
        }
        $own_goals = $this->local_score - $local_goals;
        if ($own_goals == 0) {
            return null;
        }
        return $own_goals;
    }

    public function local_own_assists() {
        $assists = LeagueStat::where('match_id', '=', $this->id)->where('assists', '>', 0)->get();
        $local_assists = 0;

        foreach ($assists as $assist) {
            if ($assist->player->participant->id == $this->local_participant->participant->id) {
                $local_assists += $assist->assists;
            }
        }
        $own_assists = $this->local_score - $local_assists;
        if ($own_assists == 0) {
            return null;
        }
        return $own_assists;
    }

    public function visitor_own_goals() {
        $goals = LeagueStat::where('match_id', '=', $this->id)->where('goals', '>', 0)->get();
        $visitor_goals = 0;

        foreach ($goals as $goal) {
            if ($goal->player->participant->id == $this->visitor_participant->participant->id) {
                $visitor_goals += $goal->goals;
            }
        }
        $own_goals = $this->visitor_score - $visitor_goals;
        if ($own_goals == 0) {
            return null;
        }
        return $own_goals;
    }

    public function visitor_own_assists() {
        $assists = LeagueStat::where('match_id', '=', $this->id)->where('assists', '>', 0)->get();
        $visitor_assists = 0;

        foreach ($assists as $assist) {
            if ($assist->player->participant->id == $this->visitor_participant->participant->id) {
                $visitor_assists += $assist->assists;
            }
        }
        $own_assists = $this->visitor_score - $visitor_assists;
        if ($own_assists == 0) {
            return null;
        }
        return $own_assists;
    }

    public function match_name()
    {
        if ($this->day) {
            $competition = $this->day->league->group->phase->competition;
            $phase = $this->day->league->group->phase;
            $group = $this->day->league->group;

            $match_name = $competition->name;
            if ($competition->phases->count() > 1) {
                $match_name .= ' - ' . $phase->name;
            }
            if ($phase->groups->count() > 1) {
                $match_name .= ' - ' . $group->name;
            }
            return $match_name . ' - Jornada ' . $this->day->order;

        } else { //playoffs
            $competition = $this->clash->round->playoff->group->phase->competition;
            $phase = $this->clash->round->playoff->group->phase;
            $group = $this->clash->round->playoff->group;
            $playoff = $this->clash->round->playoff;
            $round = $this->clash->round;

            $match_name = $competition->name;
            if ($competition->phases->count() > 1) {
                $match_name .= ' - ' . $phase->name;
            }
            if ($phase->groups->count() > 1) {
                $match_name .= ' - ' . $group->name;
            }
            if ($playoff->rounds->count() > 1) {
                $match_name .= ' - ' . $round->name;
            }
            if ($round->round_trip) {
                if ($this->order == 1) {
                    $match_name .= " - Partido de ida";
                } else {
                    $match_name .= " - Partido de vuelta";
                }
            }

            return $match_name;
        }
    }
}
