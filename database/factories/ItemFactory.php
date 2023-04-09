<?php

namespace Database\Factories;

use App\Models\ItemCategory;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minPrice = 10000; // Minimum price
        $maxPrice = 1000000; // Maximum price

        return [
            'item_category_id' => ItemCategory::inRandomOrder()->first(),
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween($minPrice, $maxPrice)
        ];
    }
}
