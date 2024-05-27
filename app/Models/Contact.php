<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'title',
        'tagline',
        'phone',
        'email',
        'address',
        'location_url',
        'office_hours_start',
        'office_hours_end',
        'background_image',
        'is_active'
    ];
}
