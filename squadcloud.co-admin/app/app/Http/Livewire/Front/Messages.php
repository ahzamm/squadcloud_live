<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Message;

class Messages extends Component
{
    public $message_data;

    public function mount()
    {
        $this->message_data = Message::first();
    }

    public function render()
    {
        return view('livewire.front.messages');
    }
}

