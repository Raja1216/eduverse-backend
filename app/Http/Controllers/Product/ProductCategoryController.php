<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductCategoryController extends Controller
{
    public function __invoke(ProductService $service)
    {
        return response()->json(
            $service->categories()
        );
    }
}
