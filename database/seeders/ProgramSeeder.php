<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'code' => 'ED03ROF1',
                'category' => 'Live Classroom',
                'sub_category' => 'Junior: Explorers',
                'product_name' => 'Raman: Offline',
                'class' => '3',
                'subject' => 'SAM',
                'duration' => '1 year',
                'mode' => 'Offline',
                'mrp' => 52200,
                'selling_price' => 34800,
                'installments' => 3,
                'cost_per_month' => 2900,
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b',
                'description' => 'Interactive classroom learning for young explorers.',
                'features' => json_encode([
                    'Expert faculty',
                    'Interactive sessions',
                    'Study materials included',
                    'Regular assessments',
                    'Parent-teacher meetings'
                ]),
                'is_active' => true
            ],

            // 👉 Add more rows exactly like this
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(
                ['code' => $program['code']],
                $program
            );
        }
    }
}

