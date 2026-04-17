<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Load parent category data from JSON file.
     *
     * @return array<int, array{name: string, description: string}>
     */
    protected static function parentCategories(): array
    {
        return json_decode(
            File::get(database_path('data/categories.json')),
            true
        );
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = $this->faker->randomElement(static::parentCategories());

        return [
            'name' => $category['name'],
            'description' => $category['description'],
            'parent_id' => null,
            'order' => 0,
            'restaurant_id' => null,
        ];
    }

    /**
     * State for a subcategory belonging to a parent category.
     */
    public function subcategory(Category $parent): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'parent_id' => $parent->id,
            'order' => $this->faker->numberBetween(0, 10),
            'restaurant_id' => null,
        ]);
    }

    /**
     * State for a restaurant-specific category.
     */
    public function forRestaurant(Restaurant $restaurant): static
    {
        return $this->state(fn (array $attributes) => [
            'restaurant_id' => $restaurant->id,
        ]);
    }
}
