<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'team_category_id', 'name', 'logo', 'slug'
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

	public function isLocalLogo() {
		if (Str::startsWith($this->logo, 'img/teams/')) {
			return true;
		}
		return false;
	}

	public function getLogoFormatted() {
		if ($this->logo) {
			$logo = $this->logo;
			$local_logo = asset($this->logo);
			$broken = asset('img/broken.png');

			if ($this->isLocalLogo()) {
				if (file_exists($logo)) {
					return $local_logo;
				} else {
					return $broken;
				}
			} else {
				if (validateUrl($logo)) {
					return $logo;
				} else {
					return $broken;
				}
			}
		} else {
			$no_logo = asset('img/team_no_image.png');
			return $no_logo;
		}

	}
}
