<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioImage;

class Portfolio extends Model
{
    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
