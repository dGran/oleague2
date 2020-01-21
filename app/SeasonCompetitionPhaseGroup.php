<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhaseGroup extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases_groups';

    protected $fillable = ['phase_id', 'name', 'num_participants', 'slug'];

    public function phase()
    {
        return $this->hasOne('App\SeasonCompetitionPhase', 'id', 'phase_id');
    }

    public function participants()
    {
        return $this->hasMany('App\SeasonCompetitionPhaseGroupParticipant', 'group_id', 'id');
    }

    public function league()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupLeague', 'group_id', 'id');
    }

    public function playoff()
    {
        return $this->hasOne('App\PlayOff', 'group_id', 'id');
    }

    public function phase_slug_if_necesary()
    {
        if ($this->phase->groups->count() > 1) {
            return $this->phase->slug;
        } else {
            if ($this->phase->competition->phases->count() > 1) {
                return $this->phase->slug;
            } else {
                return null;
            }
        }
    }

    public function group_slug_if_necesary()
    {
        if ($this->phase->groups->count() > 1) {
            return $this->slug;
        } else {
            return null;
        }
    }

    public function name() {
        $phase = SeasonCompetitionPhase::find($this->phase->id);
        if ($phase->groups->count() > 1) {
            return $this->name;
        } else {
            return null;
        }
    }
}
