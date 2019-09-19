<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeDetail extends Model
{
	protected $table = 'trades_detail';
	protected $fillable = ['trade_id', 'player1_id', 'player2_id'];
	public $timestamps = false;

    public function player1()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player1_id');
    }

    public function player2()
    {
        return $this->hasOne('App\SeasonPlayer', 'id', 'player2_id');
    }

    public function trade()
    {
        return $this->belongsTo('App\Trade', 'trade_id');
    }

}
