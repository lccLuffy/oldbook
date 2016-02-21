<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($count = 0; $count < 15; $count++) {
            Category::create([
                'name' => '标签' . $count,
                'meta_description' => '标签描述'. $count . str_random(3),
                'category_image' => str_random(25)
            ]);
        }
    }
}
