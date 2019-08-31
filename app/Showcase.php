<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
	protected $table = 'showcase';

    protected $fillable = ['player_id'];

    public function season_player()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player_id');
    }
}
