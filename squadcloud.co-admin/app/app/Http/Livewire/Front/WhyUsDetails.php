<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\WhyUs;


class WhyUsDetails extends Component
{
    public $whyUs;

    public function mount()
    {
        $this->whyUs = WhyUs::where('active',1)->limit(8)->get();
    }

    public function render()
    {
        return view('livewire.front.why-us-details');
    }
}
