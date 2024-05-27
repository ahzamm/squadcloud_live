<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $table = "resellers";
    //
    protected $fillable = [
        'username','email','first_name','last_name'.'nic','address','phone','category','city','area','active','image','status_user','created_at','updated_at','description'
    ];
}
