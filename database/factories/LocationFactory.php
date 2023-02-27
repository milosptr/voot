<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'name' => $this->faker->name(),
          'address' => $this->faker->address(),
          'city' => $this->faker->city(),
          'zip' => $this->faker->postcode(),
          'state' => null,
          'country' => $this->faker->countryCode(),
          'phone' => $this->faker->phoneNumber(),
          'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
