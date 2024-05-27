<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HomeSideMenu extends Model
{
    protected $fillable = [
        "address" , 
        'email' ,
        'phone',
    ];
}