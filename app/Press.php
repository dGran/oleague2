<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
	protected $table = 'press';

    protected $fillable = ['participant_id', 'title', 'description'];

    public function participant()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant_id');
    }

    public function participant_exists()
    {
        if ($this->participant) {
            return true;
        } else {
            return false;
        }
    }
}
