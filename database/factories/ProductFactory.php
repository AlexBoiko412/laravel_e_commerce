<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'brand_id'    => Brand::factory(),
            'name'        => ucfirst($name),
            'slug'        => Str::slug($name),
            'description' => $this->faker->paragraphs(3, true),
            'is_active'   => true,
        ];
    }
}
