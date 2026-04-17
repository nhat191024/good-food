<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Customer;

/**
 * @extends UserFactory<Customer>
 */
class CustomerFactory extends UserFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Customer>
     */
    protected $model = Customer::class;

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Customer $customer) {
            $customer->assignRole(Role::CUSTOMER->value);
        });
    }
}
