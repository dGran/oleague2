<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'players_db_id', 'game_id', 'name', 'img', 'height', 'age', 'foot', 'nation_name', 'team_name', 'league_name', 'position', 'overall_rating', 'slug', 'pack_id'
    ];

    public function playerDb()
    {
        return $this->hasOne('App\PlayerDB', 'id', 'players_db_id');
    }

    public function pack()
    {
        return $this->hasOne('App\SeasonPlayerPack', 'id', 'pack_id');
    }

    public function name_addslashes()
    {
    	return addslashes($this->name);
    }

    public function nation_flag()
    {
    	if ($this->nation_name) {
    		return 'img/flags/' . strtoupper(str_slug($this->nation_name)) . '.png';
    	}
    }

    public function pesdb2019_link() {
    	return 'http://pesdb.net/pes2019/?id=' . $this->game_id;
    }

    public function pesdb2020_link() {
    	return 'http://pesdb.net/pes2020/?id=' . $this->game_id;
    }

    public function pesdb2021_link() {
    	return 'http://pesdb.net/pes2021/?id=' . $this->game_id;
    }

    public function pesmaster2019_link() {
    	return 'https://www.pesmaster.com/' . str_slug($this->name) . '/pes-2019/player/' . $this->game_id .'/';
    }

    public function pesmaster2020_link() {
    	return 'https://www.pesmaster.com/' . str_slug($this->name) . '/pes-2020/player/' . $this->game_id .'/';
    }

    public function pesmaster2021_link() {
    	return 'https://www.pesmaster.com/' . str_slug($this->name) . '/pes-2021/player/' . $this->game_id .'/';
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

	public function getPositionFormatted() {
		$content = "<div style='background: ". $this->getPositionColor() . "; border: 1px solid grey; width: 2.25em' class='rounded p-1'>
            <span class='font-weight-bold text-white'>
                <small>" . $this->position . "</small>
            </span>
        </div>";
        return $content;
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
		    case ($this->overall_rating <=74):
		        return "#ffffff";
		}
	}

	public function getOverallRatingColorText() {
		if ($this->overall_rating >89) {
			$text_color = '#ffffff';
		} else {
			$text_color = '#212529';
		}

		return $text_color;
	}

	public function getOverallRatingFormatted() {
		if ($this->overall_rating >89) {
			$text_color = 'text-white';
		} else {
			$text_color = 'text-dark';
		}
		$color = $this->getOverallRatingColor();
		$content = "<div style='background: " . $color . "; border: 1px solid grey; width: 2.25em' class='rounded p-1'>
            <span class='font-weight-bold " . $text_color . "'>
                <small>" . $this->overall_rating . "</small>
            </span>
        </div>";
        return $content;
	}

	public function getBall() {
		switch ($this->overall_rating) {
		    case ($this->overall_rating >84):
		        return "img/black_ball.png";
		    case ($this->overall_rating >79):
		        return "img/yellow_ball.png";
		    case ($this->overall_rating >74):
		        return "img/silver_ball.png";
		    case ($this->overall_rating >69):
		        return "img/bronze_ball.png";
		    case ($this->overall_rating <=69):
		        return "img/white_ball.png";
		}
	}

	public function getIconPosition() {
		switch ($this->position) {
		    case ($this->position == "DC") || ($this->position == "SD") || ($this->position == "EI") || ($this->position == "ED"):
		        return "img/clubs/dc.png";
		    case ($this->position == "MCD") || ($this->position == "MC") || ($this->position == "MP") || ($this->position == "II") || ($this->position == "ID"):
		        return "img/clubs/mc.png";
		    case ($this->position == "CT") || ($this->position == "LD") || ($this->position == "LI"):
		        return "img/clubs/ct.png";
		    case "PT":
		        return "img/clubs/pt.png";
		}
	}
}
