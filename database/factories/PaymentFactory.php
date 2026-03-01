<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'       => Order::factory(),
            'provider'       => $this->faker->randomElement(['stripe', 'paypal']),
            'transaction_id' => 'TXN_' . Str::upper(Str::random(16)),
            'amount'         => 0,
            'status'         => 1,
        ];
    }
}
