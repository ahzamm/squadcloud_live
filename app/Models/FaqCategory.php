<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $table = 'faq_categories';
    protected $fillable = ['category', 'is_active', 'sortIds'];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
