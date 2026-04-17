<?php

namespace Database\Factories;

use App\Enums\RestaurantStatus;
use App\Models\Location;
use App\Models\Restaurant;
use App\Models\RestaurantOwner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Restaurant>
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $open = $this->faker->numberBetween(6, 10);
        $close = $this->faker->numberBetween(20, 23);

        return [
            'owner_id' => RestaurantOwner::factory(),
            'name' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'opening_time' => sprintf('%02d:00:00', $open),
            'closing_time' => sprintf('%02d:00:00', $close),
            'address' => $this->faker->streetAddress(),
            'location_id' => Location::whereNotNull('parent_id')->inRandomOrder()->value('id'),
            'rating' => $this->faker->randomFloat(1, 3.0, 5.0),
            'rating_count' => $this->faker->numberBetween(0, 500),
            'commission_percentage' => 0,
            'status' => RestaurantStatus::ACTIVE,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Restaurant $restaurant) {
            $restaurant
                ->addMedia(public_path('demo/restaurant-avatar.jpg'))
                ->preservingOriginal()
                ->toMediaCollection('avatar');

            $restaurant
                ->addMedia(public_path('demo/restaurant-banner.png'))
                ->preservingOriginal()
                ->toMediaCollection('banner');
        });
    }
}
