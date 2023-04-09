<?php

namespace Database\Factories;

use App\Models\ItemCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemCategory>
 */
class ItemCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'parent_category_id' => $this->faker->boolean(50)
                ? (ItemCategory::inRandomOrder()->first()->id ?? null)
                : null,
        ];
    }
}
