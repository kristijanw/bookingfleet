<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateStatusReservation extends Controller
{
    public function __construct(
        private DatabaseManager $database
    ) {}

    public function __invoke(Request $request, $order_id)
    {
        try {
            $this->database->transaction(function () use ($request, $order_id) {
                $order = Order::where('id', $order_id)->first();

                if ($order) {
                    $order->update([
                        'status' => OrderStatus::Delivered,
                    ]);

                    // Notify the user about the status update
                    // $order->notify(new OrderStatusUpdated($order->id));
                }
            }, 3);
        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->route('home')->with('qrcode-error', 'Greška prilikom skeniranja QR koda!');
        }
    }
}
