<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Cpanel extends Model
{
    protected $table = "cpanel";
    protected $fillable = [
    	'domain',
        'port',
        'username',
        'password',
        'status'
    ];
}
