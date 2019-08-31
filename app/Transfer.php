<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
	protected $table = 'transfers';

    protected $fillable = ['type', 'player_id', 'participant_from', 'participant_to', 'price'];

    public function player()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player_id');
    }

    public function participant_from()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_from');
    }

    public function participant_to()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_to');
    }
}
