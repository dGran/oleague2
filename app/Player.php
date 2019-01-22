<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'players_db_id', 'game_id', 'name', 'img', 'height', 'age', 'nation_name', 'team_name', 'league_name', 'position', 'overall_rating', 'slug'
    ];

    public function playerDb()
    {
        return $this->hasOne('App\PlayerDB', 'id', 'players_db_id');
    }

	public function scopeName($query, $name)
	{
		if (trim($name) !="") {
			$query->where("name", "LIKE", "%$name%");
		}
	}

	public function scopePlayerDbId($query, $playerDbId)
	{
		if (trim($playerDbId) !="") {
			$query->where("players_db_id", "=", $playerDbId);
		}
	}

	public function scopeTeamName($query, $teamName)
	{
		if (trim($teamName) !="") {
			$query->where("team_name", "LIKE", "%$teamName%");
		}
	}

	public function scopeNationName($query, $nationName)
	{
		if (trim($nationName) !="") {
			$query->where("nation_name", "LIKE", "%$nationName%");
		}
	}

	public function scopePosition($query, $position)
	{
		if (trim($position) !="") {
			$query->where("position", "LIKE", "%$position%");
		}
	}

	public function isLocalImg() {
		if (starts_with($this->img, 'img/players/')) {
			return true;
		}
		return false;
	}

	public function getImgFormatted() {
		if ($this->img) {
			$img = $this->img;
			$local_img = asset($this->img);
			$broken = asset('img/player_no_image.png');

			if ($this->isLocalImg()) {
				if (file_exists($img)) {
					return $local_img;
				} else {
					return $broken;
				}
			} else {
				if (validateUrl($img)) {
					return $img;
				} else {
					return $broken;
				}
			}
		} else {
			$no_img = asset('img/player_no_image.png');
			return $no_img;
		}

	}
}
