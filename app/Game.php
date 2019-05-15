<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'name', 'img', 'slug'
    ];

	public function scopeName($query, $name)
	{
		if (trim($name) !="") {
			$query->where("name", "LIKE", "%$name%");
		}
	}

	public function isLocalImg() {
		if (starts_with($this->img, 'img/games/')) {
			return true;
		}
		return false;
	}

	public function getImgFormatted() {
		if ($this->img) {
			$img = $this->img;
			$local_img = asset($this->img);
			$broken = asset('img/broken.png');

			if ($this->isLocalimg()) {
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
			$no_img = asset('img/no-photo.png');
			return $no_img;
		}
	}
}
