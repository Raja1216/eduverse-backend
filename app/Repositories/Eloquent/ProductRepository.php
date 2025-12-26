<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function paginate(array $filters): LengthAwarePaginator
    {
        $query = Product::where('is_active', true);

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['class'])) {
            $query->where('class', $filters['class']);
        }

        if (!empty($filters['subject'])) {
            $query->where('subject', $filters['subject']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                  ->orWhere('description', 'like', "%{$filters['search']}%");
            });
        }

        // Sorting
        if (!empty($filters['sort'])) {
            match ($filters['sort']) {
                'price_asc' => $query->orderBy('price', 'asc'),
                'price_desc' => $query->orderBy('price', 'desc'),
                'name_asc' => $query->orderBy('name'),
                default => null
            };
        }

        return $query->paginate($filters['limit'] ?? 12);
    }

    public function findById(int $id): ?Product
    {
        return Product::where('is_active', true)->find($id);
    }

    public function featured(int $limit = 8)
    {
        return Product::where('is_active', true)
            ->where('is_featured', true)
            ->limit($limit)
            ->get();
    }

    public function categories()
    {
        return Product::select('category')
            ->distinct()
            ->pluck('category');
    }
}
