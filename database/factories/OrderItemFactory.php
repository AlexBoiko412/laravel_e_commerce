<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $variant = ProductVariant::inRandomOrder()->first() ?? ProductVariant::factory()->create();

        return [
            'order_id'               => Order::factory(),
            'product_variant_id'     => $variant->id,
            'quantity'               => $this->faker->numberBetween(1, 3),
            'unit_price_at_purchase' => $variant->price,
            'tax_at_purchase'        => $variant->price * 0.1, // 10% tax snapshot
        ];
    }
}
