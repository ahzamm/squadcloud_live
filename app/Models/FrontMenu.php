<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontMenu extends Model
{
    protected $table="front_menus";
    protected $fillable = [
        'menu',
'slug',
'tagline',
'title_image',
'is_active'
    ];
}
