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
}
