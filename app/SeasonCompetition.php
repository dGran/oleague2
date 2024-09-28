<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SeasonCompetition extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'season_id', 'name', 'img', 'slug'
    ];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'season_id');
    }

    public function phases()
    {
        return $this->hasmany('App\SeasonCompetitionPhase', 'competition_id', 'id');
    }

    public function initialPhase()
    {
        return $phase = $this->phases->first();
    }

    public function scopeSeasonId($query, $seasonID)
    {
        if (trim($seasonID) !="") {
            $query->where("season_id", "=", $seasonID);
        }
    }

    public function isLocalImg() {
        if (Str::startsWith($this->img, 'img/competitions/')) {
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
            $no_img = asset('img/no-photo.png');
            return $no_img;
        }

    }
}
