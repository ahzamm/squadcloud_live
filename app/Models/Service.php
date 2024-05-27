<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = ['service', 'slug', 'logo'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->service);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->service);
        });
    }
}
