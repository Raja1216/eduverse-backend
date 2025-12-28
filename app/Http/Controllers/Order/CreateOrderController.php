<?php
namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CreateOrderController extends Controller
{
    public function __invoke(Request $request, OrderService $service)
    {
        $data = $request->validate([
            'shipping_address' => 'nullable|array',
            'billing_address' => 'nullable|array'
        ]);

        return response()->json(
            $service->createOrder($request->user()->id, $data),
            201
        );
    }
}
