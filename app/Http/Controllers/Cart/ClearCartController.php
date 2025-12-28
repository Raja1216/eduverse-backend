<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class ClearCartController extends Controller
{
    public function __invoke(Request $request, CartService $service)
    {
        $service->clearCart($request->user()->id);
        return response()->json(['message' => 'Cart cleared']);
    }
}
