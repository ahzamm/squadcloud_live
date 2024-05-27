<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    //
    protected $fillable = [
        'title','slogan','image','image_alt','video','active'
    ];
}
