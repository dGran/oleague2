<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamCategory extends Model
{
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

    public function teams()
    {
        return $this->hasmany('App\team', 'team_category_id', 'id');
    }

    public function hasTeams()
    {
    	if ($this->teams->count() > 0) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
