<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class ThankYou extends Component
{
    #[Title('Thank you')]
    public function render()
    {
        return view('livewire.thank-you');
    }
}
