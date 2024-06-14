<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio;

class PortfolioImage extends Model
{
    protected $table = 'portfolio_images';
    protected $fillable = ['portfolio_id', 'image'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
