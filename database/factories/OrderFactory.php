<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // We create a user first so we can link their addresses
        $user = User::factory()->create();

        return [
            'user_id'             => $user->id,
            'order_number'        => 'ORD-' . strtoupper(Str::random(10)),
            'status'              => 0,
            'currency'            => 'UAH',
            'total_price'         => 0,
            'tax_amount'          => 0,
            'shipping_amount'     => 15.00,
            'shipping_address_id' => Address::factory()->create(['user_id' => $user->id])->id,
            'billing_address_id'  => Address::factory()->create(['user_id' => $user->id])->id,
        ];
    }
}
