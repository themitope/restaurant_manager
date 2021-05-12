<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $categories = \App\Models\Category::factory(5)->create();
        $categories->each(function($category){
            \App\Models\Menu::factory(3)->create([
                'category_id' => $category->id,
            ]);
        });
        
    }
}
