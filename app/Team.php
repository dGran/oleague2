<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'team_category_id', 'name', 'logo',
    ];

    public function category()
    {
        return $this->hasOne('App\TeamCategory', 'id', 'team_category_id');
    }

	public function scopeName($query, $name)
	{
		if (trim($name) !="") {
			$query->where("name", "LIKE", "%$name%");
		}
	}

	public function scopeTeamCategoryId($query, $teamCategoryId)
	{
		if (trim($teamCategoryId) !="") {
			$query->where("team_category_id", "=", $teamCategoryId);
		}
	}
}
