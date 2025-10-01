<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provinces = \App\Models\Province::all()->pluck('id');

        return [
            'name'          => $this->faker->city(),
            'province_id'   => $this->faker->randomElement($provinces),
        ];
    }
}
