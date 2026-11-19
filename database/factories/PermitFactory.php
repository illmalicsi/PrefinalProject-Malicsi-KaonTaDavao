<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'permit_no' => fake()->unique()->numerify('DVO-2026-####'),
            'expires_on' => fake()->dateTimeBetween('today', '+2 years')->format('Y-m-d'),
        ];
    }

    public function expired(): static
    {
        return $this->state(fn(array $attributes) => [
            'expires_on' => fake()->dateTimeBetween('-2 years', '-1 day')->format('Y-m-d'),
        ]);
    }
}
