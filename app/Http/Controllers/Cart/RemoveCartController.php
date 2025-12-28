<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class RemoveCartController extends Controller
{
    public function __invoke(int $id, Request $request, CartService $service)
    {
        $service->removeFromCart($request->user()->id, $id);
        return response()->json(['message' => 'Item removed']);
    }
}
