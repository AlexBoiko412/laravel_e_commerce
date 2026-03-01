<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\AddressType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'type'         => $this->faker->randomElement(AddressType::cases()),
            'first_name'   => $this->faker->firstName(),
            'last_name'    => $this->faker->lastName(),
            'phone'        => $this->faker->phoneNumber(),
            'line1'        => $this->faker->streetAddress(),
            'line2'        => $this->faker->optional(0.3)->address(),
            'city'         => $this->faker->city(),
            'state'        => $this->faker->city(),
            'postal_code'  => $this->faker->postcode(),
            'country_code' => 'UA',
            'is_default'   => false,
        ];
    }
}
