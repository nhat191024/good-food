<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Food>
 */
class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Food>
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(rand(2, 3), true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(15000, 200000),
            'restaurant_id' => Restaurant::factory(),
            'category_id' => Category::whereNotNull('parent_id')->inRandomOrder()->value('id'),
            'sale_count' => 0,
            'like_count' => 0,
            'is_required_variation' => false,
            'is_available' => true,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Food $food) {
            $food
                ->addMedia(public_path('demo/food.jpg'))
                ->preservingOriginal()
                ->toMediaCollection('thumbnail');
        });
    }

    /**
     * State for food that requires a variation to be selected.
     */
    public function requiredVariation(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_required_variation' => true,
        ]);
    }
}
