<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Social extends Model
{
    protected $fillable = [
        'icon','url','status','created_at' , 'color', 'name'
    ];
}