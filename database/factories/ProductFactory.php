<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'thumb_image' => 'test.jpg',
            'category_id' => function () {
                return ProductCategory::inRandomOrder()->first()->id;
            },
            'short_description' => fake()->sentence(),
            'long_description' => fake()->paragraph(),
            'price' => fake()->randomFloat(3, 10, 100),
            'offer_price' => fake()->randomFloat(3, 10, 100),
            'quantity' => 10,
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'show_at_home' => fake()->boolean(),
            'status' => fake()->boolean()
        ];
    }
}
