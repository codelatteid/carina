<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Vps extends Model
{
    protected $table = "vps";
    protected $fillable = [
    	'ip',
        'port',
        'user',
        'password',
        'server_info',
        'status'
    ];
}
