<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function __invoke(int $id, Request $request, OrderService $service)
    {
        return response()->json(
            $service->getOrder($request->user()->id, $id)
        );
    }
}
