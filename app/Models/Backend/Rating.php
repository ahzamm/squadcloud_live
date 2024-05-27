<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;


    public function Linkproduct(){

      return $this->BelongsTo(Product::class, 'product_id', 'id');
        
  }

}
