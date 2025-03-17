<?php

namespace App\Livewire\Excursion;

use App\Models\Excursion;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Single extends Component
{
    public $id;
    public $headerImg = '/img/bgheader.jpg';

    public $availableDates;
    public $times = [];

    public $selectedStartTime;
    public $countAdults = 1;
    public $countChildren = 1;
    public $countChildrenUnder = 1;

    public function mount()
    {
        $excursion = Excursion::with('excursionTime')->where('id', $this->id)->first();

        foreach ($excursion->excursionTime as $time) {
            $date = Carbon::parse($time->date)->toDateString();
            $this->availableDates[] = $date;
        }
    }

    public function setStartTime($time)
    {
        $this->selectedStartTime = null;
        $this->selectedStartTime = $time;
    }

    public function updateCount($type, $operation)
    {
        if (!in_array($type, ['countAdults', 'countChildren', 'countChildrenUnder'])) {
            return;
        }

        if ($operation === 'increment') {
            $this->$type++;
        } elseif ($operation === 'decrement' && $this->$type > 1) {
            $this->$type--;
        }
    }

    #[On('fetchStartTime')]
    public function fetchStartTime($datum, $id)
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
