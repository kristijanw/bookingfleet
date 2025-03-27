<?php

namespace App\Livewire;

use App\Facades\Cart;
use Livewire\Attributes\Title;
use Livewire\Component;

class ThankYou extends Component
{
    public $total;
    public $content;
    public $usedCoupon;

    public function mount(): void
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
        $this->usedCoupon = Cart::getCoupon();
    }

    #[Title('Thank you')]
    public function render()
    {
        return view('livewire.thank-you', [
            'total' => $this->total,
            'content' => $this->content,
            'usedCoupon' => $this->usedCoupon,
        ]);
    }
}
