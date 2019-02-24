<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminFilter extends Model
{

    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
