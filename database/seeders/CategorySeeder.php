<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category_name' => 'electronic',
            'is_fragile' => 1,
            'is_hazardous' => 1
        ]);

        Category::create([
            'category_name' => 'clothes',
            'is_fragile' => 0,
            'is_hazardous' => 0
        ]);

        Category::create([
            'category_name' => 'books',
            'is_fragile' => 0,
            'is_hazardous' => 0
        ]);

        Category::create([
            'category_name' => 'kitchen apliances',
            'is_fragile' => 1,
            'is_hazardous' => 1
        ]);
    }
}
