<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    protected $fillable = ['ip_address', 'port', 'created_at', 'is_timeout'];
}
