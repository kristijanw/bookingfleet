<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Models\Coupon;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

class CartComponent extends Component
{
    public $total;
    public $content;
    public $usedCoupon;

    #[Validate('required')]
    public $coupon;

    public function mount(): void
    {
        $this->updateCart();
    }

    public function applyCoupon()
    {
        $this->validate();

        $coupon = Coupon::where('code', $this->coupon)->first();

        if (!$coupon) {
            $this->addError('coupon', 'Kupon ne postoji.');
            return;
        }

        // Provjera datuma
        if ($coupon->valid_to && now()->gt($coupon->valid_to)) {
            $this->addError('coupon', 'Kupon je istekao.');
            return;
        }

        // Provjera broja korištenja (samo ako max_uses > 0)
        if ($coupon->max_uses > 0 && $coupon->times_used >= $coupon->max_uses) {
            $this->addError('coupon', 'Kupon je dosegao maksimalni broj korištenja.');
            return;
        }

        // Ako sve prolazi, primijeni kupon
        Cart::applyCoupon([
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->discount,
        ]);

        $coupon->increment('times_used');

        $this->usedCoupon = Cart::getCoupon();

        $this->dispatch('productAddedToCart');
    }

    public function removeCoupon()
    {
        $coupon = Coupon::where('code', Cart::getCoupon()['code'])->first();
        $coupon->decrement('times_used');

        Cart::removeCoupon();
        $this->reset(['coupon']);
        $this->dispatch('productAddedToCart');
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
        $this->dispatch('productAddedToCart');
    }

    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->dispatch('productAddedToCart');
    }

    #[On('productAddedToCart')]
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
        $this->usedCoupon = Cart::getCoupon();
    }

    #[Title('Cart')]
    public function render(): View
    {
        return view('livewire.cart-component', [
            'total' => $this->total,
            'content' => $this->content,
            'usedCoupon' => $this->usedCoupon,
        ]);
    }
}
