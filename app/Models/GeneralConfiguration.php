<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralConfiguration extends Model
{
    protected $fillable = [
        'brand_logo','brand_name','site_footer' , 'facebook_url' , 'linkedin_url' , 'whatsapp_url' , 'twitter_url', 'otp_status'
    ];
}
