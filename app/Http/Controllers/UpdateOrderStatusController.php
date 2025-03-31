<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatusController extends Controller
{
    public function __construct(
        private DatabaseManager $database
    ) {}

    public function __invoke(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('home')->with('qrcode-error', 'Greška prilikom skeniranja QR koda!');
        }

        if ($order->status === OrderStatus::Delivered) {
            return redirect()->route('home')->with('qrcode-error', 'Rezervacija je već ažurirana!');
        }

        try {
            $this->database->transaction(function () use ($order) {
                // Update the order status to Delivered
                $order->status = OrderStatus::Delivered;
                $order->save();

                // Notify the user about the status update
                $order->notify(new OrderStatusUpdated($order->id));
            }, 3);

            return redirect()->route('home')->with('qrcode-success', 'Rezervacija je uspješno ažurirana!');
        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->route('home')->with('qrcode-error', 'Greška prilikom skeniranja QR koda!');
        }
    }
}
