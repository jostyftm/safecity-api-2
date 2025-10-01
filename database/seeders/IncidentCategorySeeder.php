<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncidentCategorySeeder extends Seeder
{
    private array $categories = [
        '🤜🤛 Pelea',
        '🚔 Robo',
        '🚨 Violencia',
        '🛑 Acoso',
        '⚠️ Vandalismo',
        '🚷 Discriminación',
        '🔥 Incendio',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->categories as $category) {
            \App\Models\IncidentCategory::factory()->create([
                'name' => $category,
            ]);
        }
    }
}
