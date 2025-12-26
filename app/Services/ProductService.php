<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepo
    ) {}

    public function listProducts(array $filters)
    {
        return $this->productRepo->paginate($filters);
    }

    public function getProduct(int $id)
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new Exception('Product not found');
        }

        return $product;
    }

    public function featuredProducts(int $limit = 8)
    {
        return $this->productRepo->featured($limit);
    }

    public function categories()
    {
        return $this->productRepo->categories();
    }
}
