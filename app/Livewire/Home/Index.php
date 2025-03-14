<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Index extends Component
{
    public $headerImg = '/img/bgheader.jpg';

    public function render()
    {
        return view('livewire.home.index')->layout('components.layouts.app', [
            'title' => 'Booking Fleet',
            'headerImg' => '/img/bgheader.jpg'
        ]);
    }
}
