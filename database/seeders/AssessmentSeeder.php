<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assessment;

class AssessmentSeeder extends Seeder
{
    public function run(): void
    {
        $assessments = [
            [
                'title' => 'EAST Level 1: Foundation',
                'description' => 'Foundation level assessment.',
                'class' => '3-5',
                'price' => 499,
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b',
                'features' => json_encode([
                    'Skill analysis',
                    'Performance report',
                    'Certificate'
                ]),
                'is_active' => true
            ],
        ];

        foreach ($assessments as $assessment) {
            Assessment::create($assessment);
        }
    }
}

