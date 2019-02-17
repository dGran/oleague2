<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'active_season_id', 'telegram_bot_token', 'telegram_channel_id', 'telegram_username_not'
    ];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'active_season_id');
    }
}