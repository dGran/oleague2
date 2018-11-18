<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'name', 'img', 'slug'
    ];

	public function isLocalImg() {
		if (starts_with($this->img, 'img/nations/')) {
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
			$no_img = asset('img/team_no_image.png');
			return $no_img;
		}

	}
}
