<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i < 2; $i++) {
            $item = Product::factory()->create()->each(
                    function (Product $product) {
                        for ($i = 0; $i < 5; $i++) {
                            $characteristic = Characteristic::select('*')
                                    ->inRandomOrder()// here is yours limit
                                    ->first();
                            //$product->characteristic()->associate($characteristic);
                           $characteristic->product_id=$product->id;
                           $characteristic->save();

                        }

                    }
            );

        }
    }
}
