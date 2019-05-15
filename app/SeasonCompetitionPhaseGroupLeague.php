<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetitionPhaseGroupLeague extends Model
{
	public $timestamps = false;
	protected $table = 'season_competitions_phases_groups_leagues';

    protected $fillable = ['group_id', 'allow_draws', 'win_points', 'draw_points', 'lose_points', 'play_amount', 'win_amount', 'draw_amount', 'lose_amount', 'stats_mvp', 'stats_goals', 'stats_assists', 'stats_yellow_cards', 'stats_red_cards'];

    public function group()
    {
        return $this->hasOne('App\SeasonCompetitionPhaseGroup', 'id', 'group_id');
    }

    public function days()
    {
        return $this->hasMany('App\SeasonCompetitionPhaseGroupLeagueDay', 'league_id', 'id');
    }

    public function table_zones()
    {
        return $this->hasMany('App\SeasonCompetitionPhaseGroupLeagueTableZone', 'league_id', 'id');
    }

}
