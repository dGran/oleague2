<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';

    protected $fillable = ['type', 'transfer_id', 'match_id', 'press_id', 'category', 'title', 'description', 'img'];

    public function transfer()
    {
        return $this->hasOne('App\Transfer', 'id', 'transfer_id');
    }

    public function press()
    {
        return $this->hasOne('App\Press', 'id', 'press_id');
    }

    public function match()
    {
        return $this->hasOne('App\SeasonCompetitionMatch', 'id', 'match_id');
    }

    public function match_exists()
    {
        if ($this->match) {
            return true;
        } else {
            return false;
        }
    }
}
