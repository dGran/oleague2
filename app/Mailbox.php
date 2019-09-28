<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
	protected $table = 'mailbox';

    protected $fillable = [
        'user_id', 'text', 'trade_id', 'read'
    ];
}
