<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $table = 'gallary';
    protected $fillable = ['image', 'is_active', 'sortIds'];
}
