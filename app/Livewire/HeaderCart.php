<?php

namespace App\Livewire;

use App\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class HeaderCart extends Component
{
    protected $total;
    protected $content;

    public function mount(): void
    {
        $this->updateCart();
    }

    #[On('refreshHeaderCart')]
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }

    public function render()
    {
        return view('livewire.header-cart', [
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }
}
