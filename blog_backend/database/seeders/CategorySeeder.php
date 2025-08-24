<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainCategories = Category::factory(5)->create();

        foreach ($mainCategories as $main) {
            $subCategories = Category::factory(rand(2, 3))->create([
                'parent_id' => $main->id,
            ]);

            foreach ($subCategories as $sub) {
                Category::factory(rand(1, 2))->create([
                    'parent_id' => $sub->id,
                ]);
            }
        }
    }
}
