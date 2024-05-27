<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontMenu extends Model
{
    protected $table="front_menus";
    protected $fillable = [
        'menu','created_at','updated_at','menu_id'
    ];
}
