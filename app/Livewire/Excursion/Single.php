<?php

namespace App\Livewire\Excursion;

use App\Models\Excursion;
use Livewire\Component;

class Single extends Component
{
    public $id;
    public $headerImg = '/img/bgheader.jpg';

    public function render()
    {
        $excursion = Excursion::find($this->id);

        return view('livewire.excursion.single', [
            'excursion' => $excursion,
        ])->layout('components.layouts.app', [
            'title' => 'ok',
            'headerImg' => asset('storage') . '/' . $excursion->header_img
        ]);
    }
}
