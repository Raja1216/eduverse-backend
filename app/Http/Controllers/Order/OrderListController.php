<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function __invoke(Request $request, OrderService $service)
    {
        return response()->json(
            $service->listOrders($request->user()->id)
        );
    }
}
