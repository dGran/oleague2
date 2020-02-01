<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayOffRoundClash extends Model
{
	public $timestamps = false;
	protected $table = 'playoffs_rounds_clashes';

    protected $fillable = ['round_id', 'order', 'local_id', 'visitor_id', 'table_position', 'clash_destiny_id', 'clash_destiny_position', 'date_limit', 'active'];

    public function round()
    {
        return $this->hasOne('App\PlayOffRound', 'id', 'round_id');
    }

    public function local_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'local_id');
    }

    public function visitor_participant()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupParticipant', 'id', 'visitor_id');
    }

    public function matches()
    {
        return $this->hasMany('App\SeasonCompetitionMatch', 'clash_id', 'id');
    }

    public function first_match()
    {
        return SeasonCompetitionMatch::where('clash_id', '=', $this->id)->where('order', '=', 1)->first();
    }

    public function local_participant_name()
    {
        if ($this->local_participant) {
            return $this->local_participant->participant->name();
        } else {
            return "No definido";
        }
    }

    public function visitor_participant_name()
    {
        if ($this->visitor_participant) {
            return $this->visitor_participant->participant->name();
        } else {
            return "No definido";
        }
    }

    public function winner()
    {
        $local_score = 0;
        $visitor_score = 0;
        $penalties_local_score = 0;
        $penalties_visitor_score = 0;
        if ($this->matches->count() > 0) {
            foreach ($this->matches as $match) {
                if (!is_null($match->local_score) && !is_null($match->visitor_score)) {
                    if ($match->order == 1) {
                        $local_score += $match->local_score;
                        $visitor_score += $match->visitor_score;
                        if (!$this->round->round_trip) {
                            $penalties_local_score += $match->penalties_local_score;
                            $penalties_visitor_score += $match->penalties_visitor_score;
                        }
                    } else {
                        $local_score += $match->visitor_score;
                        $visitor_score += $match->local_score;
                        $penalties_local_score += $match->penalties_local_score;
                        $penalties_visitor_score += $match->penalties_visitor_score;
                    }
                } else {
                    return 0;
                }
            }

            if ($local_score == $visitor_score) {
                // FALTA aplicar valor doble
                if ($penalties_local_score > $penalties_visitor_score) {
                    $winner = $this->local_id;
                } else {
                    $winner = $this->visitor_id;
                }
            } else {
                if ($local_score > $visitor_score) {
                    $winner = $this->local_id;
                } else {
                    $winner = $this->visitor_id;
                }
            }

            $participant = SeasonCompetitionPhaseGroupParticipant::find($winner);
            return $participant;
        } else {
            return 0;
        }
    }

    public function loser()
    {
        $local_score = 0;
        $visitor_score = 0;
        foreach ($this->matches as $match) {
            if (!is_null($match->local_score) && !is_null($match->visitor_score)) {
                if ($match->order == 1) {
                    $local_score += $match->local_score;
                    $visitor_score += $match->visitor_score;
                } else {
                    $local_score += $match->visitor_score;
                    $visitor_score += $match->local_score;
                }
            } else {
                return 0;
            }
        }

        if ($local_score == $visitor_score) {
            // aplicar penalties y valor doble
            return 0;
        } else {
            if ($local_score > $visitor_score) {
                $loser = $this->visitor_id;
            } else {
                $loser = $this->local_id;
            }
        }

        $participant = SeasonCompetitionPhaseGroupParticipant::find($loser);
        return $participant;
    }

    public function result()
    {
        if ($this->matches->count()>0) {
            $result = [];
            if ($this->round->round_trip) { // round_trip
                foreach ($this->matches as $key => $match) {
                    $result[$key]['local'] = $match->local_score;
                    $result[$key]['visitor'] = $match->visitor_score;
                    $result['pen_local'] = null;
                    $result['pen_visitor'] = null;
                }
            } else { // unique match
                $match = $this->matches->first();
                $result['local'] = $match->local_score;
                $result['visitor'] = $match->visitor_score;
                $result['pen_local'] = $match->penalties_local_score;
                $result['pen_visitor'] = $match->penalties_visitor_score;
            }
            return $result;
        } else {
            return null;
        }
    }
}
