<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Nation extends Model
{
	public $timestamps = false;
	protected $table = 'nations';

    protected $fillable = [
        'name', 'flag'
    ];

    public function flag()
    {
		return 'img/flags/' . Str::slug($this->name) . '.png';
	}
}
