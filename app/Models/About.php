<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    // use HasFactory;
    protected $table = 'about';
    protected $fillable = [
        'video_url',
        'icon_1',
        'heading_1',
        'description_1',
        'icon_2',
        'heading_2',
        'description_2',
        'icon_3',
        'heading_3',
        'description_3',
        'closing_remarks'
    ];
}
