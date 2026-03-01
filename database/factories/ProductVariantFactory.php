<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku'               => strtoupper($this->faker->unique()->bothify('??-#####')),
            'price'             => $this->faker->randomFloat(2, 10, 500),
            'compare_at_price'  => $this->faker->optional(0.3)->randomFloat(2, 501, 1000),
            'cost_price'        => $this->faker->randomFloat(2, 1, 9),
            'quantity_in_stock' => $this->faker->numberBetween(0, 100),
            'metadata'          => ['color' => $this->faker->safeColorName, 'size' => 'XL'],
        ];
    }
}
