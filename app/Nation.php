<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
	public $timestamps = false;
	protected $table = 'nations';

    protected $fillable = [
        'name', 'flag'
    ];
}
