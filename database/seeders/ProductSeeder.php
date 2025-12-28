<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Advanced Mathematics Workbook',
                'description' => 'Comprehensive mathematics practice book.',
                'price' => 499,
                'image' => 'https://images.unsplash.com/photo-1635372722656-389f87a941b7',
                'class' => '10-12',
                'subject' => 'Mathematics',
                'category' => 'Workbooks',
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'name' => 'Edudigm Classic T-Shirt',
                'description' => 'Premium cotton t-shirt.',
                'price' => 399,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab',
                'category' => 'Merchandise',
                'colors' => json_encode(['#FF6B35', '#4A90E2']),
                'is_featured' => true,
                'is_active' => true
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
