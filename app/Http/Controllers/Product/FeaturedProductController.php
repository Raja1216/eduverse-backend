<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    public function __invoke(Request $request, ProductService $service)
    {
        $limit = $request->get('limit', 8);

        return response()->json(
            $service->featuredProducts($limit)
        );
    }
}
