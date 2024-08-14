<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => fake()->randomElement(['WA', 'NY', 'NM', 'CA']),
            'strain' => fake()->word,
            'quantity' => fake()->randomNumber(),
            'unit' => fake()->randomElement(['g', 'oz', 'lb']),
            'weight' => fake()->randomFloat(2, 0, 1000),
        ];
    }
}
