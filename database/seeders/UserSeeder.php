<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\RestaurantOwner;
use App\Models\Shipper;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory(10)->create();
        Shipper::factory(10)->create();
        RestaurantOwner::factory(5)->create();
    }
}
