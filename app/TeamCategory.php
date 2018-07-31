<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamCategory extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
