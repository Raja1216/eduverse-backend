<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductDetailController extends Controller
{
    public function __invoke(int $id, ProductService $service)
    {
        return response()->json(
            $service->getProduct($id)
        );
    }
}
