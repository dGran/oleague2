<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

	public function scopeDescription($query, $description)
	{
		if (trim($description) !="") {
			$query->where("description", "LIKE", "%$description%");
		}
	}

	public function scopeTable($query, $table)
	{
		if (trim($table) !="") {
			$query->where("table", "LIKE", "%$table%");
		}
	}

	public function scopeType($query, $type)
	{
		if (trim($type) !="") {
			$query->where("type", "LIKE", "%$type%");
		}
	}

	public function scopeUserId($query, $user_id)
	{
		if (trim($user_id) !="") {
			$query->where("user_id", "LIKE", "%$user_id%");
		}
	}
}
