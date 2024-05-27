<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slideritem extends Model
{
    protected $fillable = [
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
