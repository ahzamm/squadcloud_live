<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioImage;
use App\Models\PortfolioDemoRequest;

class Portfolio extends Model
{
    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }

    public function demo_requests()
    {
        return $this->hasMany(PortfolioDemoRequest::class);
    }
}
