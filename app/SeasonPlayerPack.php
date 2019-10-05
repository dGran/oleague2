<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonPlayerPack extends Model
{
	public $timestamps = false;
	protected $table = 'season_players_packs';

    protected $fillable = [
        'season_id', 'name'
    ];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'season_id');
    }
}
