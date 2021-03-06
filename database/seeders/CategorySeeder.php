<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Generator;
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
        //
        for ($i=1;$i<30;$i++){
           $category=Category::factory()->make();
           $category->save();
        }

        for ($i=1;$i<30;$i++){
            $product=Product::factory()->make();
            $product->save();
        }
    }
}
