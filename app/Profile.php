<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $primaryKey = 'user_id';

    protected $fillable = [
        'gamertag', 'slack_id', 'avatar', 'signature', 'location', 'country_id', 'slack_notifications', 'email_notifications'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
