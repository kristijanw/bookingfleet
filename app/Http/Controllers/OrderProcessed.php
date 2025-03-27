<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
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

				foreach ($content as $item) {
					dump($item->get('options'));
				}

				dump($total);
				dd($usedCoupon);
			}, 3);

			return response()->json([
				'status' => 'ok',
				'message' => 'Uspješno kreirana rezervacija!'
			], 200);
		} catch (\Throwable $th) {
			Log::error($th);

			return response()->json([
				'status' => 'error',
				'message' => 'Greška, javite se korisničkoj podršci.'
			], 200);
		}
	}
}
