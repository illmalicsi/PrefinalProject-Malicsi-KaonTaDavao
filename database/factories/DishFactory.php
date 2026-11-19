<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Chicken Inasal',
                'Pork BBQ',
                'Sinigang',
                'Adobong Manok',
                'Pancit Canton',
                'Lechon Kawali',
                'Fried Bangus',
            ]),
            'price' => fake()->randomFloat(2, 50, 350),
            'is_bestseller' => fake()->boolean(20),
        ];
    }
}
