<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopUp extends Model
{
    protected $fillable = ["image" , 'start_date' , 'start_time' , 'end_date' , 'end_time'];

}