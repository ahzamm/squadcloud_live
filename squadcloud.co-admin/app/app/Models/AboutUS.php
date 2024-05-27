<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUS extends Model
{
    protected $table="about_us";
    protected $fillable = [
        'message','description','images','created_at','updated_at'
    ];
    public function setFilenamesAttribute($value)
    {
        $this->attributes['filenames'] = json_encode($value);
    }
}
