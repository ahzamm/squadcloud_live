<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\FrontMenu;
use App\Models\Logo;


class Menu extends Component
{
    public $frontmenus;

    public function mount()
    {
        $this->frontmenus = FrontMenu::orderby('sortIds' , 'asc')->get();
    }

    public function render()
    {
        $data['menues'] = FrontMenu::orderby("sortIds" , "asc")->get();
        $data['logo'] = Logo::where('active',true)->first();

        return view('livewire.front.menu',compact('data'));
    }
}
