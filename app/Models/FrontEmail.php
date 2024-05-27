<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontEmail extends Model
{
 protected $fillable = [
'emails' ,
'smtp_server',
'smtp_password',
'port'
 ];
}
