<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::insert([
            [
                'name' => 'Burger',
                'slug' => 'burger',
                'status' => 1,
                'show_at_home' => 1
            ],[
                'name' => 'Sandwich',
                'slug' => 'sandwich',
                'status' => 1,
                'show_at_home' => 1
            ],[
                'name' => 'Pizza',
                'slug' => 'pizza',
                'status' => 1,
                'show_at_home' => 1
            ]
        ]);
    }
}
