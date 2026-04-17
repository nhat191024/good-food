<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = json_decode(
            File::get(database_path('data/categories.json')),
            true
        );

        foreach ($categories as $index => $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'parent_id' => null,
                'order' => $index,
                'restaurant_id' => null,
            ]);
        }
    }
}
