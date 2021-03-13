<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $temp_id=null;
        if( rand(0,1) == 1){
            $temp=Category::all()->pluck('id');
            if(!$temp->isEmpty()) {
                $temp=Category::select('*')
                        ->inRandomOrder()// here is yours limit
                        ->first();
                $temp_id = $temp->id;
            }
        }

        return [
            //
            'title'=>$this->faker->title,
            'description'=>$this->faker->realText(),
            'slug'=>null,
            'price'=>$this->faker->numberBetween(0,10000),
            'category_id'=>$temp_id,

        ];
    }
}
