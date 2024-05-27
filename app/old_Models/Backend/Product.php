<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function linkProductClass()
    {
        return $this->belongsTo(ProductClass::class, 'product_class_id', 'id');
    }
}
