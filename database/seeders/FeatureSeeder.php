<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            'Suki ni Malicsi',
            'Budget Meal',
            'Halal',
            'Open 24 Hours',
            'Aircon',
            'Pet Friendly',
        ];

        foreach ($features as $feature) {
            Feature::create([
                'name' => $feature,
            ]);
        }
    }
}
