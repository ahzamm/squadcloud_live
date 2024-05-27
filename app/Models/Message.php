<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
       'image', 'message','created_at','updated_at'
    ];
  
}
