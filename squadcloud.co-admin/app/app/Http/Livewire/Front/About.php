<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\AboutUS;

class About extends Component
{
    public $about_us;

    public function mount()
    {
        $this->about_us = AboutUS::first();
    }

    public function render()
    {
        return view('livewire.front.about');
    }
}
