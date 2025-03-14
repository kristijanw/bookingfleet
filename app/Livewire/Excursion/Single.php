<?php

namespace App\Livewire\Excursion;

use App\Models\Excursion;
use Carbon\Carbon;
use Livewire\Component;

class Single extends Component
{
    public $id;
    public $headerImg = '/img/bgheader.jpg';

    public $availableDates;
    public $times = [];

    public function mount()
    {
        $this->availableDates = [
            '2025-08-19', '2025-08-20'
        ];
    }

    public function postaviDatum($datum, $id)
    {
        $excursionTime = Excursion::with('excursionTime')->where('id', $id)->first();
    
        if (!$excursionTime) {
            $this->times = [];
            return;
        }
    
        $this->times = [];
    
        foreach ($excursionTime->excursionTime as $time) {
            $excursionDate = Carbon::parse($time->date);
            $selectedDate = Carbon::parse($datum);
    
            if ($excursionDate->isSameDay($selectedDate)) {
                $this->times = array_merge($this->times, $time->start_time);
            }
        }

        $this->emit('refreshCalendarAndSlider');
    }
    

    public function render()
    {
        $excursion = Excursion::find($this->id);

        return view('livewire.excursion.single', [
            'excursion' => $excursion,
        ])->layout('components.layouts.app', [
            'title' => $excursion->title,
            'headerImg' => asset('storage') . '/' . $excursion->header_img
        ]);
    }
}
