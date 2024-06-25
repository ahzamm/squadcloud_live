<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'career';
    protected $fillable = ['top_heading', 'middle_heading', 'bottom_heading'];

}
