<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\FoodVariation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FoodVariation>
 */
class FoodVariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<FoodVariation>
     */
    protected $model = FoodVariation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => Food::factory(),
            'name' => $this->faker->word(),
            'description' => null,
            'price' => $this->faker->numberBetween(5000, 50000),
            'group' => $this->faker->randomElement(['size', 'topping', 'sauce', 'side']),
            'is_available' => true,
        ];
    }

    /**
     * State for a size variation (S, M, L).
     */
    public function size(): static
    {
        $sizes = [['name' => 'Nhỏ (S)', 'price' => 0], ['name' => 'Vừa (M)', 'price' => 5000], ['name' => 'Lớn (L)', 'price' => 10000]];
        $size = $this->faker->randomElement($sizes);

        return $this->state(fn (array $attributes) => [
            'name' => $size['name'],
            'price' => $size['price'],
            'group' => 'size',
        ]);
    }

    /**
     * State for a topping variation.
     */
    public function topping(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->randomElement(['Phô mai', 'Trứng', 'Xúc xích', 'Thịt xông khói', 'Nấm', 'Ớt']),
            'price' => $this->faker->numberBetween(5000, 20000),
            'group' => 'topping',
        ]);
    }
}
