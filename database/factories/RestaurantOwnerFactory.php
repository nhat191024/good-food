<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\RestaurantOwner;

/**
 * @extends UserFactory<RestaurantOwner>
 */
class RestaurantOwnerFactory extends UserFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<RestaurantOwner>
     */
    protected $model = RestaurantOwner::class;

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (RestaurantOwner $owner) {
            $owner->assignRole(Role::RESTAURANT_OWNER->value);
        });
    }
}
