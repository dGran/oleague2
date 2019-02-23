<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminFilter extends Model
{

    protected $fillable = [
        'user_id', 'player_filterName', 'player_filterPlayerDb', 'player_filterTeam', 'player_filterNation', 'player_filterPosition', 'player_order', 'player_pagination'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
