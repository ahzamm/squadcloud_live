<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'image',
        'link',
        'rating',
        'rating_number',
        'question',
        'answer',
        'price',
        'price_description',
        'screenshot_1',
        'screenshot_2',
        'screenshot_3',
        'background_image',
        'is_active'
    ];
}
