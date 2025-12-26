<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function __invoke(Request $request, ProductService $service)
    {
        return response()->json(
            $service->listProducts($request->all())
        );
    }
}
