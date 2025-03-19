<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    public $headerImg = '/img/bgheader.jpg';

    #[Title('Booking Fleet')]
    public function render()
    {
        return view('livewire.home.index');
    }
}
