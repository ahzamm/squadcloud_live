<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\HomeSlider;

class Slides extends Component
{
    public $slides;

    public function mount()
    {
        $this->slides = HomeSlider::where('active',1)->orderby("sortIds"  , 'asc')->get();
    }

    public function render()
    {
        return view('livewire.front.slides');
    }
}
