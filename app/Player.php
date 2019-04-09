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
				// if (validateUrl($img)) {
				if (@GetImageSize($img)) {
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

	public function getPositionColor() {
		switch ($this->position) {
		    case ($this->position == "DC") || ($this->position == "SD") || ($this->position == "EI") || ($this->position == "ED"):
		        return "#be262d";
		    case ($this->position == "MCD") || ($this->position == "MC") || ($this->position == "MP") || ($this->position == "II") || ($this->position == "ID"):
		        return "#4c9f20";
		    case ($this->position == "CT") || ($this->position == "LD") || ($this->position == "LI"):
		        return "#2269d9";
		    case "PT":
		        return "#dba00f";
		}
	}

	public function getOverallRatingColor() {
		switch ($this->overall_rating) {
		    case ($this->overall_rating >94):
		        return "#ff0200";
		    case ($this->overall_rating >89):
		        return "#ff7f00";
		    case ($this->overall_rating >79):
		        return "#ffbe00";
		    case ($this->overall_rating >74):
		        return "#ffff00";
		}
	}
}
