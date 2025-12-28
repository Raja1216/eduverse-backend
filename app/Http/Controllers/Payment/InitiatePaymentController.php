<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PayUService;

class InitiatePaymentController extends Controller
{
    public function __invoke(int $orderId, PayUService $service)
    {
        $order = Order::with('user')->findOrFail($orderId);

        return response()->json(
            $service->initiatePayment($order)
        );
    }
}
