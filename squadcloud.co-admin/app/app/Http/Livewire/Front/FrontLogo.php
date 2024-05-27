<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Logo;


class FrontLogo extends Component
{
    public $f_logo;

    public function mount()
    {
        $this->f_logo = Logo::where('active',1)->first();
    }

    public function render()
    {
        return view('livewire.front.front-logo');
    }
}
