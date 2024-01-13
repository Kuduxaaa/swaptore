<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['General', 'Tech', 'Kids', 'Family', '+18'];

        foreach ($categories as $category)
        {
            $instance = Categories::where('name', $category)->first();

            if (!$instance)
            {
                Categories::create(['name' => $category]);
            }
        }
    }
}
