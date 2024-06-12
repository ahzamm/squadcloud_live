<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'employment_type',
        'education_level',
        'experience_level',
        'skills',
        'salary_range',
        'application_deadline',
        'email',
        'phone',
        'is_active',
    ];
}
