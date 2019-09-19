<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
	protected $table = 'trades';
    protected $fillable = ['season_id', 'participant1_id', 'participant2_id', 'cash1', 'cash2', 'state'];

    public function season()
    {
        return $this->hasOne('App\Season', 'id', 'season_id');
    }

    public function participant1()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant1_id');
    }

    public function participant2()
    {
        return $this->hasOne('App\SeasonParticipant', 'id', 'participant2_id');
    }

    public function detail()
    {
        return $this->hasmany('App\TradeDetail', 'trade_id', 'id');
    }
}
