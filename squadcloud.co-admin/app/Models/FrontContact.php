<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontContact extends Model
{
    protected $fillable = [
        'name', 'email', 'message', 'phone'
    ];
}
