<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoritePlayer extends Model
{
	protected $table = 'favorite_players';
    public $timestamps = false;

    protected $fillable = ['player_id', 'participant_id'];

    public function season_player()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player_id');
    }

    public function participant()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_id');
    }
}
