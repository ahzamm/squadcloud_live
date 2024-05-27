<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenuAccess extends Model
{
    protected $fillable = [
        'user_id','sub_menu_id','menu_id' , 'create' , 'view' , 'update' , 'delete'
    ];

    public function submenu()
    {
        return $this->belongsTo('App\Models\SubMenu','sub_menu_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    } 
}
