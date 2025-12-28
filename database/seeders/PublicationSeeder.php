<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publication;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Physics Fundamentals Illustrated',
                'description' => 'Comprehensive physics textbook.',
                'class' => '10-12',
                'price' => 599,
                'image' => 'https://images.unsplash.com/photo-1636466497217-26a8cbeaf0aa',
                'features' => json_encode(['Illustrations', 'Solved examples']),
                'is_active' => true
            ],
            [
                'title' => 'Mathematics Workbook Series',
                'description' => 'Progressive practice workbooks.',
                'class' => '6-9',
                'price' => 599,
                'image' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904',
                'features' => json_encode(['Practice sets', 'Solutions']),
                'is_active' => true
            ],
        ];

        foreach ($data as $item) {
            Publication::create($item);
        }
    }
}

