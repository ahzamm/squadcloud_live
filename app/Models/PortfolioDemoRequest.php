<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio;

class PortfolioDemoRequest extends Model
{
    protected $table = 'portfolio_demo_requests';
    protected $fillable = ['portfolio_id', 'name', 'email', 'phone'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
