<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Shipper;

/**
 * @extends UserFactory<Shipper>
 */
class ShipperFactory extends UserFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Shipper>
     */
    protected $model = Shipper::class;

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Shipper $shipper) {
            $shipper->assignRole(Role::SHIPPER->value);
        });
    }
}
