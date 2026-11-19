<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $eatery = Eatery::where('slug', 'carinderia-ni-malicsi')
            ->firstOrFail();

        $tita = User::where('email', 'tita.malicsi@kaonta.test')
            ->firstOrFail();

        $owner = User::where('email', 'malicsi@kaonta.test')
            ->firstOrFail();

        $eatery->reviews()->createMany([
            [
                'user_id' => $tita->id,
                'rating' => 5,
                'body' => 'Lami kaayo! Balik-balikan ni Tita Malicsi.',
            ],
            [
                'user_id' => $owner->id,
                'rating' => 5,
                'body' => 'The food is delicious and affordable!',
            ],
            [
                'user_id' => $tita->id,
                'rating' => 4,
                'body' => 'Great food and friendly service!',
            ],
        ]);

        $factoryEateries = Eatery::where(
            'slug',
            '!=',
            'carinderia-ni-malicsi'
        )->where('is_open', true)->get();

        foreach ($factoryEateries as $factoryEatery) {
            $reviewCount = rand(0, 6);

            if ($reviewCount > 0) {
                $factoryEatery->reviews()->saveMany(
                    Review::factory()
                        ->count($reviewCount)
                        ->make()
                );
            }
        }
    }
}
