<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
	public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];

	public function scopeName($query, $name)
	{
		if (trim($name) !="") {
			$query->where("name", "LIKE", "%$name%");
		}
	}
}
