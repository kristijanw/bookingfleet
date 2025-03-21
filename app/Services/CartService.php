<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;

class CartService
{
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'shopping-cart';
    const COUPON_SESSION_KEY = 'cart_coupon';

    public function __construct(
        private SessionManager $session,
    ) {}

    public function applyCoupon(array $coupon): void
    {
        $this->session->put(self::COUPON_SESSION_KEY, $coupon);
    }

    public function removeCoupon(): void
    {
        $this->session->forget(self::COUPON_SESSION_KEY);
    }

    public function getCoupon(): ?array
    {
        return $this->session->get(self::COUPON_SESSION_KEY);
    }

    public function add($id, $name, $price, $quantity, $options = []): void
    {
        $cartItem = $this->createCartItem($name, $price, $quantity, $options);

        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem->put('quantity', $content->get($id)->get('quantity') + $quantity);
        }

        $content->put($id, $cartItem);

        $this->session->put(self::DEFAULT_INSTANCE, $content);
    }

    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            switch ($action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($id)->get('quantity') + 1);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($id, $cartItem);

            $this->session->put(self::DEFAULT_INSTANCE, $content);
        }
    }

    public function remove(string $id): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $this->session->put(self::DEFAULT_INSTANCE, $content->except($id));
        }
    }

    public function clear(): void
    {
        $this->session->forget(self::DEFAULT_INSTANCE);
    }

    public function content(): Collection
    {
        return is_null($this->session->get(self::DEFAULT_INSTANCE)) ? collect([]) : $this->session->get(self::DEFAULT_INSTANCE);
    }

    public function total(): string
    {
        $content = $this->getContent();

        $subtotal = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        }, 0);

        $coupon = $this->getCoupon();

        if ($coupon) {
            if ($coupon['type'] === 'percentage') {
                $discount = ($coupon['value'] / 100) * $subtotal;
                $subtotal -= $discount;
            } elseif ($coupon['type'] === 'fixed') {
                $subtotal -= $coupon['value'];
            }

            if ($subtotal < 0) {
                $subtotal = 0;
            }
        }

        return number_format($subtotal, 2);
    }

    protected function getContent(): Collection
    {
        return $this->session->has(self::DEFAULT_INSTANCE) ? $this->session->get(self::DEFAULT_INSTANCE) : collect([]);
    }

    protected function createCartItem(string $name, string $price, string $quantity, array $options): Collection
    {
        $price = floatval($price);
        $quantity = intval($quantity);

        if ($quantity < self::MINIMUM_QUANTITY) {
            $quantity = self::MINIMUM_QUANTITY;
        }

        return collect([
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'options' => $options,
        ]);
    }
}
