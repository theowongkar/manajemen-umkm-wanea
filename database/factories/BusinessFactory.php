<?php

namespace Database\Factories;

use App\Models\UrbanVillage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'urban_village_id' => UrbanVillage::inRandomOrder()->first()->id,
            'product_name' => fake()->word(),
            'owner_name' => fake()->name(),
            'owner_phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['Aktif', 'Tidak Aktif']),
        ];
    }
}
