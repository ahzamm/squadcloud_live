<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Package;
class PakageDetail extends Component
{
    public $sindh,$punjab,$kpk,$balochistan;
    public $max_count;
    public function render()
    {
        $this->sindh = Package::where('province','sindh')->where('active',1)->get();
        $this->punjab = Package::where('province','punjab')->where('active',1)->get();
        $this->balochistan = Package::where('province','balochistan')->where('active',1)->get();
        $this->kpk = Package::where('province','kpk')->where('active',1)->get();
        $this->maxCount();
        // dd($this->max_count);
        return view('livewire.front.pakage-detail');
    }
    private function maxCount()
    {
        $packages = [
            $this->sindh->count(),
            $this->punjab->count(),
            $this->balochistan->count(),
            $this->kpk->count()
        ];
        
        $this->max_count = max($packages);
    }
}
