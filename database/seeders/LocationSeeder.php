<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(
            File::get(database_path('data/vietnam_locations.json')),
            true
        );

        foreach ($data['locations'] as $province) {
            $parent = Location::create([
                'name' => $province['name'],
                'code' => $province['code'],
                'codename' => $province['codename'],
                'short_codename' => null,
                'type' => $province['division_type'],
                'phone_code' => $province['phone_code'] ?? null,
                'parent_id' => null,
            ]);

            foreach ($province['wards'] as $ward) {
                Location::create([
                    'name' => $ward['name'],
                    'code' => $ward['code'],
                    'codename' => $ward['codename'],
                    'short_codename' => $ward['short_codename'] ?? null,
                    'type' => $ward['division_type'],
                    'phone_code' => null,
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
