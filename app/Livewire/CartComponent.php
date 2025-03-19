<?php

namespace App\Livewire;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

class CartComponent extends Component
{
    protected $total;
    protected $content;

    public function mount(): void
    {
        $this->updateCart();
    }

    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->updateCart();
        $this->dispatch('productAddedToCart');
        $this->dispatch('refreshHeaderCart');
    }

    public function clearCart(): void
    {
        Cart::clear();
        $this->updateCart();
    }

    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->updateCart();
    }

    #[On('productAddedToCart')]
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }

    #[Title('Cart')]
    public function render(): View
    {
        return view('livewire.cart-component', [
            'total' => $this->total,
            'content' => $this->content,
        ])->layoutData([
            'hiddeBackgroundImage' => true
        ]);
    }
}
