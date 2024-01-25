<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = Category::forShop()->get();

        foreach ($categories as $category) {
            $category->delete();
        }

        $categories = Category::forFreelance()->get();
        $last_parent_id = null;

        foreach ($categories as $category) {
//            $parent_id = null;
//
//            if(!$category->parent_id) {
//                $last_parent_id = $category->id;
//            } else {
//
//            }

            $cat = Category::create([
                'for' => Category::SHOP_NAME,
                'name' => $category->name,
                'parent_id' => $last_parent_id,
            ]);

            if(!$category->parent_id) $last_parent_id = $cat->id;
        }
    }
}
