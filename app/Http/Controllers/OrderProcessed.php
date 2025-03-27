<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Log;

class OrderProcessed extends Controller
{
	public function __construct(
		private DatabaseManager $database
	) {}

	public function __invoke(Request $request)
	{
		try {
			$this->database->transaction(function () use ($request) {
				$data = $request->all();

				$total = Cart::total();
				$content = Cart::content();
				$usedCoupon = Cart::getCoupon();

				$test = $user;

				foreach ($content as $item) {
					$order = Order::create([
						'coupon' => !empty($usedCoupon) ? $usedCoupon['code'] : null,
						'total_price' => $item->get('price'),
					]);

					$order->itemOrders()->create([
						'title' => $item->get('name'),
						'trip_day' => $item->get('options')['date'],
						'start_time' => $item->get('options')['chooseTime'],
						'location' => $item->get('options')['location'],
					]);
				}
			}, 3);

			return redirect()->route('thank-you');
		} catch (\Throwable $th) {
			Log::error($th);

			return redirect()->route('cart')->with('cart-error', 'Test greška!!');
		}
	}
}
