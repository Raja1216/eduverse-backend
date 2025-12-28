<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    public function __invoke(Request $request, CartService $service)
    {
        $data = $request->validate([
            'item_type' => 'required|in:program,publication,event,assessment,product',
            'item_id' => 'required|integer',
            'quantity' => 'nullable|integer|min:1',
            'payment_option' => 'nullable|in:full,installment',
            'selected_color' => 'nullable|string',
            'selected_size' => 'nullable|string'
        ]);

        return response()->json(
            $service->addToCart($request->user()->id, $data),
            201
        );
    }
}
