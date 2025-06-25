<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitiesSeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['nama' => 'Swimming Pool', 'description' => 'Olympic size swimming pool', 'usage_count' => 150],
            ['nama' => 'Gym', 'description' => 'Fully equipped fitness center', 'usage_count' => 200],
            ['name_fasilitas' => 'Restaurant', 'description' => 'Fine dining restaurant', 'usage_count' => 300],
            ['name_fasilitas' => 'Spa', 'description' => 'Relaxation and wellness spa', 'usage_count' => 120],
            ['name_fasilitas' => 'Conference Room', 'description' => 'Business meeting facilities', 'usage_count' => 80],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
