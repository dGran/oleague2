<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        'message',
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

	public function user_profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'user_id');
    }
}
