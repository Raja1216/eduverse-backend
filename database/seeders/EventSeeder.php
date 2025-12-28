<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'National Science Olympiad 2025',
                'description' => 'India’s premier science competition.',
                'class' => '10-12',
                'price' => 299,
                'event_date' => '2025-03-15',
                'event_time' => '10:00',
                'venue' => 'Online',
                'image' => 'https://images.unsplash.com/photo-1507537297725-24a1c029d3ca',
                'features' => json_encode(['Certificate', 'Ranking']),
                'is_active' => true
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}

