<?php

namespace App\Livewire\Excursion;

use App\Models\Excursion;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Single extends Component
{
    public $id;
    public $headerImg = '/img/bgheader.jpg';

    public $totalPrice = 0.0;

    public $availableDates;
    public $times = [];

    #[Validate('required')]
    public $chooseTime;

    public $countAdults = 1;
    public $countChildren = 0;
    public $countChildrenUnder = 0;

    public $adult_eat = [];
    public $children_eat = [];

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|numeric')]
    public $phone = '';

    public function mount()
    {
        $excursion = Excursion::with('excursionTime')->where('id', $this->id)->first();

        $this->totalPrice = number_format($excursion->price, 2);

        foreach ($excursion->excursionTime as $time) {
            $date = Carbon::parse($time->date)->toDateString();
            $this->availableDates[] = $date;
        }

        $this->adult_eat = array_fill(0, $this->countAdults, 'fish');
        $this->children_eat = array_fill(0, $this->countChildren, 'fish');
    }

    public function setStartTime($time)
    {
        $this->chooseTime = $time;
    }

    public function updateCount($type, $operation)
    {
        if (!in_array($type, ['countAdults', 'countChildren', 'countChildrenUnder'])) {
            return;
        }

        if ($operation === 'increment') {
            $this->$type++;

            // Dodaj novi unos sa podrazumevanom vrednošću samo ako ne postoji
            if ($type === 'countAdults') {
                $this->adult_eat[] = 'fish';
            } elseif ($type === 'countChildren') {
                $this->children_eat[] = 'fish';
            }
        } elseif ($operation === 'decrement') {
            if ($type === 'countAdults' && $this->$type > 1) {
                $this->$type--;

                // Uklanjamo poslednjeg iz niza ako je broj odraslih smanjen
                array_pop($this->adult_eat);
            } elseif ($type !== 'countAdults' && $this->$type > 0) {
                $this->$type--;

                if ($type === 'countChildren') {
                    array_pop($this->children_eat);
                }
            }
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

    public function save()
    {
        $this->validate();

        // dd([
        //     'chooseTime' => $this->chooseTime,
        //     'countAdults' => $this->countAdults,
        //     'countChildren' => $this->countChildren,
        //     'countChildrenUnder' => $this->countChildrenUnder,
        //     'adult_eat' => $this->adult_eat,
        //     'children_eat' => $this->children_eat,
        //     'email' => $this->email,
        //     'phone' => $this->phone,
        // ]);
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
