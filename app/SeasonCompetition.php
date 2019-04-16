<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonCompetition extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'season_id', 'name', 'img', 'slug'
    ];

    public function scopeSeasonId($query, $seasonID)
    {
        if (trim($seasonID) !="") {
            $query->where("season_id", "=", $seasonID);
        }
    }

    public function isLocalImg() {
        if (starts_with($this->img, 'img/competitions/')) {
            return true;
        }
        return false;
    }

    public function getImgFormatted() {
        if ($this->img) {
            $img = $this->img;
            $local_img = asset($this->img);
            $broken = asset('img/broken.png');

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
}
