<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\FoodVariation;
use App\Models\Location;
use App\Models\Restaurant;
use App\Models\RestaurantOwner;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = RestaurantOwner::all();
        $parentCategories = Category::whereNull('parent_id')->get();
        $wardIds = Location::whereNotNull('parent_id')->pluck('id');

        foreach ($owners as $owner) {
            /** @var Restaurant $restaurant */
            $restaurant = Restaurant::factory()->create([
                'owner_id' => $owner->id,
                'location_id' => $wardIds->random(),
            ]);

            // Each restaurant picks 2–4 parent categories and creates sub-categories under them
            $selectedParents = $parentCategories->random(rand(2, 4));

            foreach ($selectedParents as $parent) {
                /** @var Category $subCategory */
                $subCategory = Category::factory()
                    ->subcategory($parent)
                    ->forRestaurant($restaurant)
                    ->create();

                // Create 4–8 foods per sub-category
                $foods = Food::factory(rand(4, 8))->create([
                    'restaurant_id' => $restaurant->id,
                    'category_id' => $subCategory->id,
                ]);

                // ~40% of foods get variations (size, topping, sauce, side)
                foreach ($foods as $food) {
                    if (rand(1, 10) <= 4) {
                        $group = fake()->randomElement(['size', 'topping', 'sauce', 'side']);

                        FoodVariation::factory(rand(2, 4))->create([
                            'food_id' => $food->id,
                            'group' => $group,
                        ]);
                    }
                }
            }
        }
    }
}
