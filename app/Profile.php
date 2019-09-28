<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    public $timestamps = false;
	protected $primaryKey = 'user_id';

    protected $fillable = [
        'gamertag', 'avatar', 'location', 'nation_id', 'birthdate', 'email_notifications'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function age()
    {
		return Carbon::parse($this->birthdate)->age;
    }

    public function getAvatarFormatted() {
        $no_img = asset('img/avatars/default.png');
        $broken = asset('img/avatars/broken.png');
        if ($this->avatar) {
            $img = $this->avatar;
            if (@GetImageSize($img)) {
                return $img;
            } else {
                return $broken;
            }
        } else {
            return $no_img;
        }
    }
}
