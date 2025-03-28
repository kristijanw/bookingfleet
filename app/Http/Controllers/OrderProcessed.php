<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Order;
use App\Notifications\OrderProcessing;
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
				$content = Cart::content();
				$usedCoupon = Cart::getCoupon();

				foreach ($content as $item) {
					$order = Order::create([
						'title' => $item->get('name'),
						'email' => $item->get('options')['email'],
						'phone' => $item->get('options')['phone'],
						'coupon' => !empty($usedCoupon) ? $usedCoupon['code'] : null,
						'total_price' => $item->get('price'),
						'trip_day' => $item->get('options')['date'],
						'start_time' => $item->get('options')['chooseTime'],
						'location' => $item->get('options')['location'],
						'count_adults' => $item->get('options')['countAdults'],
						'count_children' => $item->get('options')['countChildren'],
						'count_children_under' => $item->get('options')['countChildrenUnder'],
						'adult_eat' => $item->get('options')['adult_eat'],
						'children_eat' => $item->get('options')['children_eat'],
						'children_price' => $item->get('options')['childrenPrice'],
						'skipper' => $item->get('options')['skipper'],
						'skipper_price' => $item->get('options')['skipperPrice'],
					]);

					$order->notify(new OrderProcessing);
				}

				Cart::clear();
			}, 3);

			return redirect()->route('thank-you');
		} catch (\Throwable $th) {
			Log::error($th);

			return redirect()->route('cart')->with('cart-error', 'Test greška!!');
		}
	}
}
