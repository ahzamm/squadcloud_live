<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Reseller;


class ResellerDetail extends Component
{
    public $resellers;

    public function mount()
    {
        $this->resellers = Reseller::where('active',1)->get();
    }

    public function render()
    {
        return view('livewire.front.reseller-detail');
    }
}
