<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $district = District::where('name', 'Poblacion')->firstOrFail();

        $sukiFeature = Feature::where('name', 'Suki ni Malicsi')->firstOrFail();
        $budgetFeature = Feature::where('name', 'Budget Meal')->firstOrFail();

        $eatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Carinderia ni Malicsi',
            'slug' => Str::slug('Carinderia ni Malicsi'),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $eatery->features()->sync([
            $sukiFeature->id,
            $budgetFeature->id,
        ]);

        $eatery->permit()->save(
            Permit::factory()->make([
                'permit_no' => 'DVO-2026-0001',
                'expires_on' => '2027-06-17',
            ])
        );

        $eatery->dishes()->createMany([
            [
                'name' => 'Tinolang Manok',
                'price' => 85.00,
                'is_bestseller' => true,
            ],
            [
                'name' => 'Kinilaw na Tuna',
                'price' => 120.00,
                'is_bestseller' => false,
            ],
            [
                'name' => 'Durian Shake',
                'price' => 75.00,
                'is_bestseller' => false,
            ],
        ]);

        for ($i = 1; $i <= 14; $i++) {
            $factoryEatery = Eatery::factory()->create();

            if ($i <= 3) {
                $factoryEatery->update([
                    'is_open' => false,
                ]);
            }

            if ($i === 1) {
                $factoryEatery->permit()->save(
                    Permit::factory()->expired()->make()
                );
            } else {
                $factoryEatery->permit()->save(
                    Permit::factory()->make()
                );
            }

            $dishCount = rand(2, 5);

            $factoryEatery->dishes()->saveMany(
                Dish::factory()->count($dishCount)->make()
            );

            $featureIds = Feature::inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id');

            $factoryEatery->features()->attach($featureIds);
        }
    }
}
