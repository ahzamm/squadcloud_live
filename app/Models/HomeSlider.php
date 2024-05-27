<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $fillable = [
        // 'title','slogan','image','image_alt','video','active'
        'heading',
        'subheading',
        'description',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'is_active'
    ];
}
