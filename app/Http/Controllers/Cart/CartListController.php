<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartListController extends Controller
{
    public function __invoke(Request $request, CartService $service)
    {
        return response()->json(
            $service->getCart($request->user()->id)
        );
    }
}
