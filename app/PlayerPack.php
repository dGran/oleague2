<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerPack extends Model
{
	public $timestamps = false;
	protected $table = 'season_players_packs';

    protected $fillable = [
        'season_id', 'name'
    ];
}
