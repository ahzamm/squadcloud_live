<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    public function linkProduct()
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}
}
