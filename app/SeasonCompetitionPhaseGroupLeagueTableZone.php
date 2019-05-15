<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhaseGroupLeagueTableZone extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases_groups_leagues_table_zones';

    protected $fillable = ['league_id', 'table_zone_id', 'position'];

    public function league()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroupLeague', 'id', 'league_id');
    }

    public function table_zone()
    {
        return $this->hasOne('App\TableZone', 'id', 'table_zone_id');
    }
}
