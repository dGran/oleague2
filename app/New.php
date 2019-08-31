<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class New extends Model
{
	protected $table = 'news';

    protected $fillable = ['type', 'transfer_id', 'match_id', 'category', 'title', 'description', 'img'];

    public function transfer()
    {
        return $this->hasOne('App\Transfer', 'id', 'transfer_id');
    }
}
