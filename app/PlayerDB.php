<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerDB extends Model
{
	protected $table = 'players_dbs';

	public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];

	public function scopeName($query, $name)
	{
		if (trim($name) !="") {
			$query->where("name", "LIKE", "%$name%");
		}
	}

    public function players()
    {
        return $this->hasmany('App\Player', 'players_db_id', 'id');
    }

    public function hasPlayers()
    {
    	if ($this->players->count() > 0) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
