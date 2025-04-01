<?php

namespace App\Livewire\Excursion;

use App\Facades\Cart;
use App\Models\Excursion;
use App\Models\ExcursionDate;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Single extends Component
{
    public $id;
    public $title;
    public $headerImg = '/img/bgheader.jpg';

    public Excursion $excursion;

    public $totalPrice = 0.0;

    public $seatAvailable;
    public $availableDates;
    public $times = [];
    public $selectedDate;
    public $skipper = 'no';

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
        $excursion = Excursion::with('excursionDate', 'category')->where('id', $this->id)->first();

        $this->excursion = $excursion;

        $this->title = $excursion->title;

        $this->seatAvailable = $excursion->boat_capacity;

        $this->totalPrice = $excursion->price;

        foreach ($excursion->excursionDate as $date) {
            $date = Carbon::parse($date->date)->toDateString();
            $this->availableDates[] = $date;
        }

        $this->adult_eat = array_fill(0, $this->countAdults, 'fish');
        $this->children_eat = array_fill(0, $this->countChildren, 'fish');
    }

    public function setStartTime($time)
    {
        $this->reset(['countAdults', 'countChildren', 'countChildrenUnder', 'adult_eat', 'children_eat', 'skipper', 'chooseTime']);
        $this->adult_eat = array_fill(0, $this->countAdults, 'fish');
        $this->children_eat = array_fill(0, $this->countChildren, 'fish');

        $excursionDate = ExcursionDate::with('excursionDateTimes')->where('date', $this->selectedDate)->first();
        $excursionDateTime = $excursionDate->excursionDateTimes()->where('time', $time)->first();

        $this->chooseTime = $excursionDateTime->time;
        $this->seatAvailable = $excursionDateTime->available_seats;
    }

    public function updateCount($type, $operation)
    {
        if (!in_array($type, ['countAdults', 'countChildren', 'countChildrenUnder'])) {
            return;
        }

        $totalPersons = $this->countAdults + $this->countChildren + $this->countChildrenUnder;

        if ($operation === 'increment') {

            if ($totalPersons >= $this->seatAvailable) {
                session()->flash('seatAvailable', 'Nema dovoljno mjesta!');
                return;
            }

            $this->$type++;

            // Dodaj novi unos sa podrazumevanom vrednošću samo ako ne postoji
            if ($type === 'countAdults') {
                $this->adult_eat[] = 'fish';
                $this->totalPrice += $this->excursion->price;
            } elseif ($type === 'countChildren') {
                $this->children_eat[] = 'fish';

                $discountRate = 1 - ($this->excursion->children_price / 100);
                $this->totalPrice += $this->excursion->price * $discountRate;
            }
        } elseif ($operation === 'decrement') {
            if ($type === 'countAdults' && $this->$type > 1) {
                $this->$type--;

                $this->totalPrice -= $this->excursion->price;

                // Uklanjamo poslednjeg iz niza ako je broj odraslih smanjen
                array_pop($this->adult_eat);
            } elseif ($type !== 'countAdults' && $this->$type > 0) {
                $this->$type--;

                if ($type === 'countChildren') {
                    $discountRate = 1 - ($this->excursion->children_price / 100);
                    $this->totalPrice -= $this->excursion->price * $discountRate;

                    array_pop($this->children_eat);
                }
            }
        }
    }

    #[On('fetchStartTime')]
    public function fetchStartTime($datum, $id)
    {
        $this->reset(['countAdults', 'countChildren', 'countChildrenUnder', 'adult_eat', 'children_eat', 'skipper', 'chooseTime']);
        $this->adult_eat = array_fill(0, $this->countAdults, 'fish');
        $this->children_eat = array_fill(0, $this->countChildren, 'fish');

        $excursion = Excursion::with('excursionDate')->where('id', $id)->first();

        if (!$excursion) {
            $this->times = [];
            return;
        }

        $this->totalPrice = $excursion->price;

        $this->times = [];
        $this->selectedDate = Carbon::parse($datum);

        $excursionDate = $excursion->excursionDate()->with('excursionDateTimes')->where('date', $datum)->first();

        if (!$excursion->excursionDate) {
            $this->times = [];
            return;
        }

        $excursionDateStart = Carbon::parse($excursionDate->date);
        $selectedDate = Carbon::parse($datum);

        if ($excursionDateStart->isSameDay($selectedDate)) {
            foreach ($excursionDate->excursionDateTimes as $time) {
                $this->times[] = $time->time;
            }
        }
    }

    public function updateSkipper()
    {
        if ($this->skipper == 'yes') {
            $this->totalPrice += $this->excursion->skipper_price;
        } else {
            $this->totalPrice -= $this->excursion->skipper_price;
        }
    }

    public function save()
    {
        $this->validate();

        // id, name, price, quantity, options = array
        Cart::add($this->id, $this->title, $this->totalPrice, 1, [
            'date' => $this->selectedDate,
            'chooseTime' => $this->chooseTime,
            'countAdults' => $this->countAdults,
            'countChildren' => $this->countChildren,
            'countChildrenUnder' => $this->countChildrenUnder,
            'adult_eat' => $this->adult_eat,
            'children_eat' => $this->children_eat,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->excursion->departure,
            'price' => $this->excursion->price,
            'childrenPrice' => $this->excursion->children_price,
            'skipper' => $this->skipper,
            'skipperPrice' => $this->excursion->skipper_price,
        ]);
        $this->dispatch('productAddedToCart');
        $this->dispatch('refreshHeaderCart');

        return $this->redirect('/cart');
    }

    public function render()
    {
        return view('livewire.excursion.single', [
            'excursion' => $this->excursion,
        ])->layout('components.layouts.app', [
            'title' => $this->excursion->title,
            'headerImg' => asset('storage') . '/' . $this->excursion->header_img,
            'opacity' => true,
        ]);
    }
}
