<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    // use HasFactory;
    // protected $table = 'about';
    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'service_required',
        'message',
    ];
}
